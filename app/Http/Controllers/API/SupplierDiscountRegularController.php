<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierList; 
use App\Models\SupplierDiscountRegular; 
use Illuminate\Support\Facades\Auth; 

class SupplierDiscountRegularController extends Controller
{
    public function getAllSupplierList()
    {
        $list = SupplierList::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $list], 200);
    }

    public function save()
    {
        $supplier = SupplierList::find(request()->supplier_uuid);

        if (!$supplier) {
            return response()->json(['success' => 0, 'message' => 'Could not find Supplier!'], 200);
        }


        $discount = new SupplierDiscountRegular();
        $discount->supplier_uuid = request()->supplier_uuid;
        $discount->discount_name = request()->discount_name;
        $discount->discount_rate = request()->discount_rate;
        $discount->save();


        $discount = SupplierDiscountRegular::find($discount->uuid);
        
        return response()->json(['success' => 1, 'data' => $discount, 'message' => 'Discount Updated!'], 200); 
    }

    public function update()
    {
        $discount = SupplierDiscountRegular::find(request()->uuid);

        if (!$discount) {
            return response()->json(['success' => 0, 'message' => 'Could not find Discount!'], 200);
        }

        $discount->discount_name = request()->discount_name;
        $discount->discount_rate = request()->discount_rate;
        $discount->save();
        
        return response()->json(['success' => 1, 'data' => $discount, 'message' => 'Discount Updated!'], 200); 
    }

    public function delete()
    {
        $supplier = SupplierDiscountRegular::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Discount Deleted!'], 200);
    }
}