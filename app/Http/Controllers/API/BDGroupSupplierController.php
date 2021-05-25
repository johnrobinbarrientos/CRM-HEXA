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

use  App\Http\Controllers\API\BDGroupSupplierDiscountController;

class BDGroupSupplierController extends Controller
{
    public function index($supplier_uuid)
    {
        $groups = BDGroupSupplier::where('supplier_uuid','=',$supplier_uuid)->with('discounts')->get();
        return response()->json(['success' => 1, 'rows' => $groups], 200);
    }

    static public function check($groups)
    {   
        $errors = 0;
        foreach ($groups as $key => $group) {
            $group['name_error'] = false;

            if (empty($group['name'])) {
                $group['name_error'] = true;
                $group['edit'] = true;
                $errors++;
            }

            $response =  BDGroupSupplierDiscountController::check($group['discounts']);

            $group['discounts'] = $response['discounts'];
            $errors += $response['errors'];

            $groups[$key] = $group;
        }

        return ['groups' => $groups, 'errors' => $errors];
    }

    static public function save($supplier_uuid,$groups)
    {
        $group_uuids = [];
        
        foreach ($groups as $key => $group) {
            if ( is_null($group['uuid'])) {
                continue;
            }
            $group_uuids[] = $group['uuid'];
        }
        
        // delete group
        BDGroupSupplier::where('supplier_uuid','=',$supplier_uuid)->whereNotIn('uuid',$group_uuids)->delete();

        foreach ($groups as $key => $group) {

            $uuid = $group['uuid'];
            $name = $group['name'];
    
            
            $data = BDGroupSupplier::where('uuid','=',$uuid)->first();
            $data = ($data) ? $data : new  BDGroupSupplier;
            $data->supplier_uuid = $supplier_uuid;
            $data->name = $name;
            $data->save();
            
            $bd_supplier = BDGroupSupplier::find($data->uuid);

            $BD_group_discounts = BDGroupSupplierDiscountController::save($bd_supplier->uuid,$group['discounts']);
        }
    }

    static public function savePOBDGroupSupplier($order,$bd_group_supplier_uuids)
    {
        $auth = \Auth::user();
        
        
        //$pobd_group_supplier_uuids = POBDGroupSupplier::where('purchase_order_uuid','=',$order->uuid)->pluck('reference_uuid')->toArray();
        
        // delete existing base discounts of the PO
        $existing_pobd_group_suppliers = POBDGroupSupplier::where('purchase_order_uuid','=',$order->uuid)->delete();

        //$selected_group_supplier_uuids = array_merge($pobd_group_supplier_uuids, $bd_group_supplier_uuids);
        $bd_group_supplier_uuids = (isset($bd_group_supplier_uuids)) ? $bd_group_supplier_uuids : [];
        $bd_group_suppliers = BDGroupSupplier::whereIn('uuid',$bd_group_supplier_uuids)->get();

  
        foreach ($bd_group_suppliers as $bd_group_supplier) {
            
            $pobd_group_supplier = POBDGroupSupplier::where('purchase_order_uuid','=',$order->uuid)
                ->where('reference_uuid','=',$bd_group_supplier->uuid)
                ->withTrashed()
                ->first();

            $pobd_group_supplier = ($pobd_group_supplier) ? $pobd_group_supplier : new POBDGroupSupplier;
            $pobd_group_supplier->reference_uuid        = $bd_group_supplier->uuid;
            $pobd_group_supplier->purchase_order_uuid   = $order->uuid;
            $pobd_group_supplier->supplier_uuid         = $bd_group_supplier->supplier_uuid;
            $pobd_group_supplier->name                  = $bd_group_supplier->name;
            $pobd_group_supplier->deleted_at            = null;
            $pobd_group_supplier->save();

            $response = BDGroupSupplierDiscountController::savePOBDGroupSupplierDiscount($order,$pobd_group_supplier);
        }
    }

}