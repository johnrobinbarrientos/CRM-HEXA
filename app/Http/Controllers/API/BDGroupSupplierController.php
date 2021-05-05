<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierList; 
use App\Models\BDGroupSupplier; 
use App\Models\BDGroupSupplierDiscount; 
use App\Models\BDGroupSupplierDiscountExcludedItem; 

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

}