<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierList; 
use App\Models\BDGroupSupplier; 
use App\Models\BDGroupSupplierDiscount; 
use App\Models\BDGroupSupplierDiscountExcludedItem; 

use App\Models\POBDGroupSupplier; 
use App\Models\POBDGroupSupplierDiscount; 
use App\Models\POBDGroupSupplierDiscountExcludedItem; 

class BDGroupSupplierDiscountController extends Controller
{
    static public function check($discounts)
    {
        $errors = 0;
        foreach ($discounts as $key => $discount) {

            $discount['name_error'] = false;
            $discount['rate_error'] = false;

            if (empty($discount['name'])) {
                $discount['name_error'] = true;
                $discount['edit'] = true;
                $errors++;
            }

            if (empty($discount['rate'])) {
                $discount['rate_error'] = true;
                $discount['edit'] = true;
                $errors++;
            }

            $discounts[$key] = $discount;
        }

        return ['discounts' => $discounts, 'errors' => $errors];
    }
    

    static public function save($bd_group_supplier_uuid,$discounts)
    {
        $discount_uuids = [];
        
        foreach ($discounts as $key => $discount) {
            if ( is_null($discount['uuid'])) {
                continue;
            }
            $discount_uuids[] = $discount['uuid'];
        }

        // delete discounts
        BDGroupSupplierDiscount::where('bd_group_supplier_uuid','=',$bd_group_supplier_uuid)->whereNotIn('uuid',$discount_uuids)->delete();

        foreach ($discounts as $key => $discount) {

            $uuid = $discount['uuid'];
            $name = $discount['name'];
            $rate = $discount['rate'];
            $deleted_at = (isset($discount['deleted_at'])) ? $discount['deleted_at'] : null;
            
            if ($deleted_at == null){
                $data = BDGroupSupplierDiscount::where('uuid','=',$uuid)->first();
                $data = ($data) ? $data : new  BDGroupSupplierDiscount;
                $data->bd_group_supplier_uuid = $bd_group_supplier_uuid;
                $data->name = $name;
                $data->rate = $rate;
                $data->save();
            } else {
                $data = BDGroupSupplierDiscount::find($uuid)->delete(); 
            }

        }
    }

    static public function savePOBDGroupSupplierDiscount($order,$pobd_group_supplier)
    {
        // delete existing base discounts of the PO
        $existing_pobd_group_supplier_discounts = POBDGroupSupplierDiscount::where('purchase_order_uuid','=',$order->uuid)->where('pobd_group_supplier_uuid','=',$pobd_group_supplier->uuid)->delete();

        $bd_group_supplier_discounts = BDGroupSupplierDiscount::where('bd_group_supplier_uuid','=',$pobd_group_supplier->reference_uuid)->get();
        
        foreach ($bd_group_supplier_discounts as $bd_group_supplier_discount) {

            $pobd_group_supplier_discount = POBDGroupSupplierDiscount::where('purchase_order_uuid','=', $order->uuid)
                ->where('reference_uuid','=', $bd_group_supplier_discount->uuid)
                ->where('pobd_group_supplier_uuid','=', $bd_group_supplier_discount->bd_group_supplier_uuid)
                ->withTrashed()
                ->first();

            $pobd_group_supplier_discount = ($pobd_group_supplier_discount) ? $pobd_group_supplier_discount : new POBDGroupSupplierDiscount;

            $pobd_group_supplier_discount->reference_uuid = $bd_group_supplier_discount->uuid;
            $pobd_group_supplier_discount->pobd_group_supplier_uuid = $pobd_group_supplier->uuid;
            $pobd_group_supplier_discount->purchase_order_uuid = $order->uuid;
            $pobd_group_supplier_discount->name = $bd_group_supplier_discount->name;
            $pobd_group_supplier_discount->rate = $bd_group_supplier_discount->rate;
            $pobd_group_supplier_discount->deleted_at = null;
            $pobd_group_supplier_discount->save();
            
        }
    }
}