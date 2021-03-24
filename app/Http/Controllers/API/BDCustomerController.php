<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\BDCustomer; 

use  App\Http\Controllers\API\BDCustomerDiscountController;

class BDCustomerController extends Controller
{
    public function index($customer_uuid)
    {
        $groups = BDCustomer::where('customer_uuid','=',$customer_uuid)->with('discounts')->get();
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

            $response =  BDCustomerDiscountController::check($group['discounts']);

            $group['discounts'] = $response['discounts'];
            $errors += $response['errors'];

            $groups[$key] = $group;
        }

        return ['groups' => $groups, 'errors' => $errors];
    }

    static public function save($customer_uuid,$groups)
    {
        foreach ($groups as $key => $group) {

            $uuid = $group['uuid'];
            $name = $group['name'];
    
            
            $data = BDCustomer::where('uuid','=',$uuid)->first();
            $data = ($data) ? $data : new  BDCustomer;
            $data->customer_uuid = $customer_uuid;
            $data->name = $name;
            $data->save();
            
            $bd_customer = BDCustomer::find($data->uuid);

            $BD_group_discounts = BDCustomerDiscountController::save($bd_customer->uuid,$group['discounts']);
        }
    }

}