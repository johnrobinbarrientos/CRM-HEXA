<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CustomerDiscountRegular; 
use Illuminate\Support\Facades\Auth;
 

class CustomerDiscountRegularController extends Controller
{

    public function save()
    {
        $discount = request()->uuid ? CustomerDiscountRegular::find(request()->uuid) : new CustomerDiscountRegular();
        $auth = \Auth::user();
        $discount->company_id = $auth->company_id;
        $discount->customer_uuid = request()->customer_uuid;
        $discount->discount_name = request()->discount_name;
        $discount->discount_rate = request()->discount_rate;
        $discount->save();


        $discount = CustomerDiscountRegular::find($discount->uuid);
        
        return response()->json(['success' => 1, 'data' => $discount], 200);
    }


    public function delete()
    {
        $discount = CustomerDiscountRegular::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Discount Deleted!'], 200);
    }
}