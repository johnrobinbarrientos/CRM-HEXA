<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierList; 
use App\Models\SupplierDiscountRegular; 
use Illuminate\Support\Facades\Auth; 

class SupplierListController extends Controller
{
    public function getAllSupplierList()
    {
        $list = SupplierList::whereNull('deleted_at')->with('SupplierGroup')->with('PaymentTerm')->with('AccountPayable')->with('discounts')->get();
        return response()->json(['success' => 1, 'rows' => $list], 200);
    }

    public function save()
    {
        $supplier = new SupplierList();
        $auth = \Auth::user();
        $supplier->company_id = $auth->company_id;
        $supplier->business_name = request()->business_name;
        $supplier->business_shortname = request()->business_shortname;
        $supplier->check_payee = request()->check_payee;
        $supplier->tax_identification_no = request()->tax_identification_no;
        $supplier->vat_uuid = request()->vat_uuid;
        $supplier->supplier_group_uuid = request()->supplier_group_uuid;
        $supplier->lead_time = request()->lead_time;
        $supplier->is_transporter = request()->is_transporter;
        $supplier->payment_term_uuid = request()->payment_term_uuid;
        $supplier->coa_payable_account_uuid = request()->coa_payable_account_uuid;
        $supplier->email = request()->email;
        $supplier->contact_no = request()->contact_no;
        $supplier->global_address_uuid = request()->global_address_uuid;
        $supplier->Address1 = request()->Address1;
        $supplier->save();

        $discounts = request()->discounts;

        foreach ($discounts as $d)
        {
            $discount = new SupplierDiscountRegular;
            $discount->supplier_uuid = $supplier->uuid;
            $discount->discount_name = $d['discount_name'];
            $discount->discount_rate = $d['discount_rate'];
            $discount->save();
        }

        $supplier = SupplierList::find($supplier->uuid);
        return response()->json(['success' => 1, 'data' => $supplier, 'message' => 'Supplier Added!'], 200); 
    }


    public function update()
    {
        $supplier = SupplierList::find(request()->uuid);

        if (!$supplier) {
            return response()->json(['success' => 0, 'message' => 'Could not find Supplier!'], 200);
        }

        $supplier->business_name = request()->business_name;
        $supplier->business_shortname = request()->business_shortname;
        $supplier->check_payee = request()->check_payee;
        $supplier->tax_identification_no = request()->tax_identification_no;
        $supplier->vat_uuid = request()->vat_uuid;
        $supplier->supplier_group_uuid = request()->supplier_group_uuid;
        $supplier->lead_time = request()->lead_time;
        $supplier->is_transporter = request()->is_transporter;
        $supplier->payment_term_uuid = request()->payment_term_uuid;
        $supplier->coa_payable_account_uuid = request()->coa_payable_account_uuid;
        $supplier->email = request()->email;
        $supplier->contact_no = request()->contact_no;
        $supplier->global_address_uuid = request()->global_address_uuid;
        $supplier->Address1 = request()->Address1;
        $supplier->save();
        
        return response()->json(['success' => 1, 'data' => $supplier, 'message' => 'Supplier Updated!'], 200); 
    }

    public function delete()
    {
        $supplier = SupplierList::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Supplier Deleted!'], 200);
    }
}