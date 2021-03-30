<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CustomerBranch; 
use Illuminate\Support\Facades\Auth; 

class CustomerBranchController extends Controller
{

    public function getBranchesByCustomer($customerUUID)
    {
        $list = CustomerBranch::where('customer_uuid','=',$customerUUID)->whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $list], 200);
    }

    static public function check($branches)
    {
        $errors = 0;
        foreach ($branches as $key => $branch) {

            $branch['contact_no_error'] = false;
            $branch['name_error'] = false;


            if (empty($branch['contact_no'])) {
                $branch['contact_no_error'] = true;
                $errors++;
            }

            if (empty($branch['customer_name'])) {
                $branch['customer_name_error'] = true;
                $errors++;
            }


            $branches[$key] = $branch;
        }

        return ['branches' => $branches, 'errors' => $errors];
    }

    static public function save($customer_uuid,$branches)
    {

        $branch_uuids = [];
        
        foreach ($branches as $key => $branch) {
            if ( is_null($branch['uuid'])) {
                continue;
            }
            $branch_uuids[] = $branch['uuid'];
        }
        
        // delete payees
        CustomerBranch::where('customer_uuid','=',$customer_uuid)->whereNotIn('uuid',$branch_uuids)->delete();

        foreach ($branches as $key => $branch) {

            $uuid = $branch['uuid'];
            $customer_name = $branch['customer_name'];
            $contact_person = $branch['contact_person'];
            $address = $branch['address'];
            $email_address = $branch['email_address'];
            $contact_no = $branch['contact_no'];
            $is_active = $branch['is_active'];
    
            
            $data = CustomerBranch::where('uuid','=',$uuid)->first();
            $data = ($data) ? $data : new  CustomerBranch;
            $data->customer_uuid = $customer_uuid;
            $data->customer_name = $customer_name;
            $data->contact_person = $contact_person;
            $data->address = $address;
            $data->email_address = $email_address;
            $data->contact_no = $contact_no;
            $data->is_active = $is_active;
            $data->save();
            
            $bd_customer = CustomerBranch::find($data->uuid);
        }
    }

}