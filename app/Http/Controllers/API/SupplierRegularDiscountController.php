<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierRegularDiscount; 
use Illuminate\Support\Facades\Auth;
 

class SupplierRegularDiscountController extends Controller
{
    public function getSupplierRegularDiscount()
    {
        $discount = SupplierRegularDiscount::whereNull('deleted_at')->where('supplier_uuid', request()->supplier_uuid)->get();
        return response()->json(['success' => 1, 'rows' => $discount], 200);
    }

    public function save()
    {
        $discount = request()->uuid ? SupplierRegularDiscount::find(request()->uuid) : new SupplierRegularDiscount();
        $auth = \Auth::user();
        $discount->company_id = $auth->company_id;
        $discount->supplier_uuid = request()->supplier_uuid;
        $discount->discount_type = request()->discount_type;
        $discount->discount_name = request()->discount_name;
        $discount->discount_rate = request()->discount_rate;
        $discount->discount_fixed = request()->discount_fixed;
        $discount->is_active = request()->is_active;
        $discount->save();


        $discount = SupplierRegularDiscount::find($discount->uuid);
        
        return response()->json(['success' => 1, 'data' => $discount], 200);
    }


    public function delete()
    {
        $supplier = SupplierRegularDiscount::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Discount Deleted!'], 200);
    }
}