<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CustomerList; 
use App\Models\CustomerDiscountRegular; 
use Illuminate\Support\Facades\Auth; 

use  App\Http\Controllers\API\BDCustomerController;
use  App\Http\Controllers\API\CustomerBranchController;

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


    public function store()
    {
        return $this->save();
    }

    public function update($uuid) 
    {
        return $this->save($uuid);
    }

    public function save($uuid = '')
    {

        $children = (object) request()->children;

        $groups = (isset($children->discount_groups)) ? $children->discount_groups : [];
        $check = BDCustomerController::check($groups);

        if ($check['errors'] > 0) {
           return response()->json(['success' => 0, 'groups' => $check['groups'], 'errors' => $check['errors'], 'tab' => 'discounts' ], 500);
        }

        $branches = (isset($children->branches)) ? $children->branches : [];
        $check = CustomerBranchController::check($branches);

        if ($check['errors'] > 0) {
           return response()->json(['success' => 0, 'branches' => $check['branches'], 'errors' => $check['errors'], 'tab' => 'check-branches' ], 500);
        }

        $customer =  CustomerList::find($uuid);
        $customer = ($customer) ? $customer : new CustomerList();

        $customer->sold_to_name = request()->sold_to_name;
        $customer->business_group_name = request()->business_group_name;
        $customer->business_shortname = request()->business_shortname;
        $customer->tax_id_no = request()->tax_id_no;
        $customer->customer_group_uuid = request()->customer_group_uuid;
        $customer->customer_chain_uuid = request()->customer_chain_uuid;
        $customer->customer_channel_uuid = request()->customer_channel_uuid;
        $customer->customer_type_uuid = request()->customer_type_uuid;
        $customer->cost_center_uuid = request()->cost_center_uuid;
        $customer->vat_uuid = (request()->is_vat) ? request()->vat_uuid : null;
        $customer->payment_term_uuid = request()->payment_term_uuid;
        $customer->coa_receivable_account_uuid = request()->coa_receivable_account_uuid;
        $customer->is_active = request()->is_active;
        $customer->email = request()->email;
        $customer->contact_person = request()->contact_person;
        $customer->contact_no = request()->contact_no;
        $customer->address_uuid = request()->address_uuid;
        $customer->address1 = request()->address1;
        $customer->is_draft = 0;
        $customer->save();

        $customer = CustomerList::find($customer->uuid);
        
        $bd_customer_save = BDCustomerController::save($customer->uuid,$groups);

        $branches_save = CustomerBranchController::save($customer->uuid,$branches);


        return response()->json(['success' => 1, 'rows' => $customer], 200);
    }


    public function show($customerUUID) // set update records
    {
        $customer = CustomerList::with('discounts')->with('CustomerGroup')->with('CustomerChain')->with('CustomerChannel')->with('CustomerType')
        ->with('PaymentTerm')->find($customerUUID);

        if (!$customer) {
            return response()->json(['success' => 0, 'data' => null, 'Not found'], 500);
        }
        return response()->json(['success' => 1, 'data' => $customer], 200);
    }


    public function delete($customer_uuid)
    {
        $customer = CustomerList::find($customer_uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}