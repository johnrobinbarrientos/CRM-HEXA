<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierBaseDiscountGroupItem;
use App\Models\SupplierBaseDiscountGroup; 
use App\Models\SupplierBaseDiscountGroupDetail;  
use Illuminate\Support\Facades\Auth; 

class SupplierBaseDiscountGroupItemController extends Controller
{
    public function save()
    {
        $auth = \Auth::user();

        $item_uuid = request()->item_uuid;
        $supplier_uuid = request()->supplier_uuid;
        $supplier_base_discount_group_uuid = request()->uuid;
        $supplier_base_discount_group = SupplierBaseDiscountGroup::where('uuid','=',$supplier_base_discount_group_uuid)->first();

        if (!$supplier_base_discount_group) {
            return response()->json(['success' => 0, 'message' => 'An error occur while saving...'], 500);
        }

        $delete = SupplierBaseDiscountGroupItem::where('item_uuid','=',$item_uuid)->where('supplier_uuid','=',$supplier_uuid)->delete();
        $item_supplier_discount = SupplierBaseDiscountGroupItem::where('item_uuid','=',$item_uuid)->where('supplier_base_discount_group_uuid','=',$supplier_base_discount_group->uuid)->first();
        $item_supplier_discount = ($item_supplier_discount) ? $item_supplier_discount : new SupplierBaseDiscountGroupItem;
        
        $item_supplier_discount->item_uuid = $item_uuid;
        $item_supplier_discount->supplier_uuid = $supplier_uuid;
        $item_supplier_discount->supplier_base_discount_group_uuid = $supplier_base_discount_group_uuid;
        $item_supplier_discount->save();
        
        $item_supplier_discount = SupplierBaseDiscountGroupItem::find($item_supplier_discount->uuid);

        return response()->json(['success' => 1, 'data' => $item_supplier_discount], 200);
    }

    public function delete()
    {
        $auth = \Auth::user();

        $item_uuid = request()->item_uuid;
        $supplier_base_discount_group_uuid = request()->uuid;
        
        $supplier_base_discount_group = SupplierBaseDiscountGroup::where('uuid','=',$supplier_base_discount_group_uuid)->first();

        if (!$supplier_base_discount_group) {
            return response()->json(['success' => 0, 'message' => 'An error occur while saving...'], 500);
        }
        
        $item_supplier_discount = SupplierBaseDiscountGroupItem::where('item_uuid','=',$item_uuid)->where('supplier_base_discount_group_uuid','=',$supplier_base_discount_group->uuid)->first();
        
        if (!$item_supplier_discount) {
            return response()->json(['success' => 0, 'message' => 'Discount not found!'], 500);
        }

        $item_supplier_discount->forceDelete();
       

        return response()->json(['success' => 1, 'rows' => $item_supplier_discount], 200);
    }

    public function deleteBatch()
    {
        $auth = \Auth::user();
        $item_uuid = request()->item_uuid;
        $supplier_ids = (is_array(request()->supplier_ids)) ? request()->supplier_ids : [];

        $item_supplier_discounts = SupplierBaseDiscountGroupItem::whereNotIn('supplier_uuid',$supplier_ids)->where('item_uuid','=',$item_uuid)->forceDelete();

        return response()->json(['success' => 1, 'message' => 'Deleted removed supplier discounts!'], 200);
        
    }
}