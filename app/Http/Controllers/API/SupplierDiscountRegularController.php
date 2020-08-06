<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierDiscountRegular; 
use Illuminate\Support\Facades\Auth;
 

class SupplierDiscountRegularController extends Controller
{

    public function save()
    {
        $discount = request()->uuid ? SupplierDiscountRegular::find(request()->uuid) : new SupplierDiscountRegular();
        $auth = \Auth::user();
        $discount->company_id = $auth->company_id;
        $discount->supplier_uuid = request()->supplier_uuid;
        $discount->discount_name = request()->discount_name;
        $discount->discount_rate = request()->discount_rate;
        $discount->save();


        $discount = SupplierDiscountRegular::find($discount->uuid);
        
        return response()->json(['success' => 1, 'data' => $discount], 200);
    }


    public function delete()
    {
        $supplier = SupplierDiscountRegular::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Discount Deleted!'], 200);
    }
}