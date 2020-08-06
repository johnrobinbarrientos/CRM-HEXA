<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CustomerList; 
use App\Models\CustomerDiscountRegular; 
use Illuminate\Support\Facades\Auth; 

class CustomerListController extends Controller
{
    public function getCustomerList()
    {
        $list = CustomerList::whereNull('deleted_at')->with('discounts')
        ->with('CustomerGroup')->with('CustomerChain')
        ->with('CustomerChannel')->with('CustomerType')
        ->with('PaymentTerm')
        ->get();
        return response()->json(['success' => 1, 'rows' => $list], 200);
    }

    public function save()
    {
        $customer = request()->uuid ? CustomerList::find(request()->uuid) : new CustomerList();
        $auth = \Auth::user();
        $customer->company_id = $auth->company_id;
        $customer->sold_to_name = request()->sold_to_name;
        $customer->business_group_name = request()->business_group_name;
        $customer->business_shortname = request()->business_shortname;
        $customer->tax_id_no = request()->tax_id_no;
        $customer->customer_group_uuid = request()->customer_group_uuid;
        $customer->global_customer_chain_uuid = request()->global_customer_chain_uuid;
        $customer->global_customer_channel_uuid = request()->global_customer_channel_uuid;
        $customer->global_customer_type_uuid = request()->global_customer_type_uuid;
        $customer->vat_uuid = request()->vat_uuid;
        $customer->payment_term_uuid = request()->payment_term_uuid;
        $customer->coa_receivable_account_uuid = request()->coa_receivable_account_uuid;
        $customer->is_applied_vat = request()->is_applied_vat;
        $customer->email = request()->email;
        $customer->contact_person = request()->contact_person;
        $customer->contact_no = request()->contact_no;
        $customer->global_address_uuid = request()->global_address_uuid;
        $customer->address1 = request()->address1;
        $customer->save();

        
        if (request()->uuid===null){ 

            $discounts = request()->discounts;
            
            foreach ($discounts as $d)
            {
                $discount = new CustomerDiscountRegular;
                $auth = \Auth::user();
                $discount->company_id = $auth->company_id;
                $discount->customer_uuid = $customer->uuid;
                $discount->discount_name = $d['discount_name'];
                $discount->discount_rate = $d['discount_rate'];
                $discount->save();
            }
        }

        $customer = CustomerList::find($customer->uuid);
        return response()->json(['success' => 1, 'rows' => $customer], 200);
    }


    public function delete()
    {
        $customer = CustomerList::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}