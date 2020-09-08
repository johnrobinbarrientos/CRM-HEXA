<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierPriceRule; 
use Illuminate\Support\Facades\Auth;
 

class SupplierPriceRuleController extends Controller
{
    public function getSupplierPriceRule()
    {
        $discount = SupplierPriceRule::whereNull('deleted_at')->where('supplier_uuid', request()->supplier_uuid)->get();
        return response()->json(['success' => 1, 'rows' => $discount], 200);
    }

    public function save()
    {
        $discount = request()->uuid ? SupplierPriceRule::find(request()->uuid) : new SupplierPriceRule();
        $auth = \Auth::user();
        $discount->company_id = $auth->company_id;
        $discount->supplier_uuid = request()->supplier_uuid;
        $discount->discount_type = request()->discount_type;
        $discount->discount_name = request()->discount_name;
        $discount->discount_rate = request()->discount_rate;
        $discount->discount_fixed = request()->discount_fixed;
        $discount->date_start = request()->date_start;
        $discount->date_end = request()->date_end;
        $discount->save();


        $discount = SupplierPriceRule::find($discount->uuid);
        
        return response()->json(['success' => 1, 'data' => $discount], 200);
    }


    public function delete()
    {
        $supplier = SupplierPriceRule::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Discount Deleted!'], 200);
    }
}