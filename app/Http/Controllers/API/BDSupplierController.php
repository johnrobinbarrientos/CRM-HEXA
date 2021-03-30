<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierList; 
use App\Models\BDSupplier; 
use App\Models\BDSupplierDiscount; 
use App\Models\BDSupplierDiscountExcludedItem; 

use  App\Http\Controllers\API\BDSupplierDiscountController;

class BDSupplierController extends Controller
{
    public function index($supplier_uuid)
    {
        $groups = BDSupplier::where('supplier_uuid','=',$supplier_uuid)->with('discounts')->get();
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

            $response =  BDSupplierDiscountController::check($group['discounts']);

            $group['discounts'] = $response['discounts'];
            $errors += $response['errors'];

            $groups[$key] = $group;
        }

        return ['groups' => $groups, 'errors' => $errors];
    }

    static public function save($supplier_uuid,$groups)
    {
        
        foreach ($groups as $key => $group) {
            
            $uuid = $group['uuid'];
            $name = $group['name'];
            $deleted_at = $group['deleted_at'];
    
            if ($deleted_at == null){
                $data = BDSupplier::where('uuid','=',$uuid)->first();
                $data = ($data) ? $data : new  BDSupplier;
                $data->supplier_uuid = $supplier_uuid;
                $data->name = $name;
                $data->save();

                $bd_supplier = BDSupplier::find($data->uuid);
                
                $BD_group_discounts = BDSupplierDiscountController::save($bd_supplier->uuid,$group['discounts']);

            }
            else {
                $bd_supplier = BDSupplier::find($uuid)->delete();

                $BD_group_discounts = BDSupplierDiscountController::save($uuid,$group['discounts']);
            }
            
            // var_dump($group['uuid']);
            // die();

            
        }
    }

}