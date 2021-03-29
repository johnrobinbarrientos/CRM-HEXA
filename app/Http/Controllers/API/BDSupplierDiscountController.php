<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierList; 
use App\Models\BDSupplier; 
use App\Models\BDSupplierDiscount; 
use App\Models\BDSupplierDiscountExcludedItem; 


class BDSupplierDiscountController extends Controller
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
    

    static public function save($bd_supplier_uuid,$discounts)
    {
        foreach ($discounts as $key => $discount) {

            $uuid = $discount['uuid'];
            $name = $discount['name'];
            $rate = $discount['rate'];
            $deleted_at = $discount['deleted_at'];
            
            if ($deleted_at == null){
                $data = BDSupplierDiscount::where('uuid','=',$uuid)->first();
                $data = ($data) ? $data : new  BDSupplierDiscount;
                $data->bd_supplier_uuid = $bd_supplier_uuid;
                $data->name = $name;
                $data->rate = $rate;
                $data->save();
            }
            else {
                $data = BDSupplierDiscount::find($uuid)->delete(); 
            }

        }
    }
}