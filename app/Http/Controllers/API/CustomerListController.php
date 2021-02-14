<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CustomerList; 
use App\Models\CustomerDiscountRegular; 
use Illuminate\Support\Facades\Auth; 

class CustomerListController extends Controller
{
    public function index()
    {
        $list = CustomerList::where('is_draft','=', 0)->whereNull('deleted_at')->with('discounts')
        ->with('CustomerGroup')->with('CustomerChain')
        ->with('CustomerChannel')->with('CustomerType')
        ->with('PaymentTerm');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('sold_to_name','LIKE','%'.$keyword.'%')
                    ->orWhere('business_group_name','LIKE','%'.$keyword.'%')
                    ->orWhere('business_shortname','LIKE','%'.$keyword.'%');
            });
        }

        $count = $list->count();

        // pagination
        $take = (is_numeric(request()->take) && request()->take <= 100) ? request()->take: 20;
        $page = (is_numeric(request()->page)) ? request()->page : 1;
        $offset = (($page - 1 ) * $take);

        $list = $list->take($take);
        $list = $list->offset($offset);
        $list = $list->get();

        return response()->json(['success' => 1, 'rows' => $list, 'count' => $count, 'offset' => $offset, 'results' => count($list)], 200);
    }

    public function store() // initialize draft
    {
        $customer =  CustomerList::where('is_draft','=', 1)->first();

        if (!$customer) {
            $auth = \Auth::user();

            $customer = new CustomerList();

            $customer->save();
        }


        $customer = CustomerList::find($customer->uuid);
        return response()->json(['success' => 1, 'data' => $customer], 200);
    }

    public function update()
    {
        $customer =  CustomerList::find(request()->uuid);
        
        if (!$customer) {
            return response()->json(['success' => 0, 'data' => null, 'Not found'], 500);
        }

        $customer->sold_to_name = request()->sold_to_name;
        $customer->business_group_name = request()->business_group_name;
        $customer->business_shortname = request()->business_shortname;
        $customer->tax_id_no = request()->tax_id_no;
        $customer->customer_group_uuid = request()->customer_group_uuid;
        $customer->global_customer_chain_uuid = request()->global_customer_chain_uuid;
        $customer->global_customer_channel_uuid = request()->global_customer_channel_uuid;
        $customer->global_customer_type_uuid = request()->global_customer_type_uuid;
        $customer->global_cost_center_uuid = request()->global_cost_center_uuid;
        $customer->vat_uuid = request()->vat_uuid;
        $customer->payment_term_uuid = request()->payment_term_uuid;
        $customer->coa_receivable_account_uuid = request()->coa_receivable_account_uuid;
        $customer->is_applied_vat = request()->is_applied_vat;
        $customer->email = request()->email;
        $customer->contact_person = request()->contact_person;
        $customer->contact_no = request()->contact_no;
        $customer->global_address_uuid = request()->global_address_uuid;
        $customer->address1 = request()->address1;
        $customer->is_draft = 0;
        $customer->save();

        
        if (request()->uuid===null){ 

            $discounts = request()->discounts;
            
            foreach ($discounts as $d)
            {
                $discount = new CustomerDiscountRegular;

                $discount->customer_uuid = $customer->uuid;
                $discount->discount_name = $d['discount_name'];
                $discount->discount_rate = $d['discount_rate'];
                $discount->save();
            }
        }

        $customer = CustomerList::find($customer->uuid);
        return response()->json(['success' => 1, 'rows' => $customer], 200);
    }

    public function show($customerUUID) // set update records
    {
        $customer = CustomerList::with('discounts')
        ->with('CustomerGroup')->with('CustomerChain')
        ->with('CustomerChannel')->with('CustomerType')
        ->with('PaymentTerm')->find($customerUUID);

        if (!$customer) {
            return response()->json(['success' => 0, 'data' => null, 'Not found'], 500);
        }
        return response()->json(['success' => 1, 'data' => $customer], 200);
    }


    public function delete()
    {
        $customer = CustomerList::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}