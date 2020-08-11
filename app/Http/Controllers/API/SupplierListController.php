<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierList; 
use App\Models\SupplierDiscountRegular; 
use Illuminate\Support\Facades\Auth; 

class SupplierListController extends Controller
{
    public function getSupplierList()
    {
        $list = SupplierList::whereNull('deleted_at')->with('SupplierGroup')->with('PaymentTerm')->with('AccountPayable')->with('discounts')->get();
        return response()->json(['success' => 1, 'rows' => $list], 200);
    }

    public function save()
    {
        $supplier = request()->uuid ? SupplierList::find(request()->uuid) : new SupplierList();
        $auth = \Auth::user();
        $supplier->company_id = $auth->company_id;
        $supplier->business_name = request()->business_name;
        $supplier->business_shortname = request()->business_shortname;
        $supplier->check_payee = request()->check_payee;
        $supplier->tax_identification_no = request()->tax_identification_no;
        $supplier->vat_uuid = request()->vat_uuid;
        $supplier->ewt_uuid = request()->ewt_uuid;
        $supplier->supplier_group_uuid = request()->supplier_group_uuid;
        $supplier->lead_time = request()->lead_time;
        $supplier->is_transporter = request()->is_transporter;
        $supplier->payment_term_uuid = request()->payment_term_uuid;
        $supplier->coa_payable_account_uuid = request()->coa_payable_account_uuid;
        $supplier->email = request()->email;
        $supplier->contact_no = request()->contact_no;
        $supplier->global_address_uuid = request()->global_address_uuid;
        $supplier->address1 = request()->address1;
        $supplier->save();

        

        if (request()->uuid===null){ 

            $discounts = request()->discounts;
            
            foreach ($discounts as $d)
            {
                $discount = new SupplierDiscountRegular;
                $auth = \Auth::user();
                $discount->company_id = $auth->company_id;
                $discount->supplier_uuid = $supplier->uuid;
                $discount->discount_name = $d['discount_name'];
                $discount->discount_rate = $d['discount_rate'];
                $discount->start_date = $d['start_date'];
                $discount->end_date = $d['end_date'];
                $discount->is_active = $d['is_active'];
                $discount->discount_type = $d['discount_type'];
                $discount->save();
            }
        }

        $supplier = SupplierList::find($supplier->uuid);
        return response()->json(['success' => 1, 'rows' => $supplier], 200);
    }


    public function delete()
    {
        $supplier = SupplierList::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Supplier Deleted!'], 200);
    }
}