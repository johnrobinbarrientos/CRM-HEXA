<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierBaseDiscountGroupItem; 
use App\Models\SupplierList; 
use App\Models\SupplierBaseDiscountGroup; 
use App\Models\SupplierBaseDiscountGroupDetail; 
use Illuminate\Support\Facades\Auth; 

class SupplierBaseDiscountGroupController extends Controller
{
    public function getSupplierBaseDiscountGroups($supplierUUID)
    {
        $discount_groups = SupplierBaseDiscountGroup::where('supplier_uuid','=',$supplierUUID)->get();
        return response()->json(['success' => 1, 'rows' => $discount_groups], 200);
    }

    public function getSupplierBaseDiscountGroupsMultiple()
    {
        $auth = \Auth::user();

        $item_uuid = request()->item_uuid;
        $supplier_ids = (is_array(request()->supplier_ids)) ? request()->supplier_ids : [];
        

        $suppliers = SupplierList::whereIn('uuid',$supplier_ids)->get();

        foreach ($suppliers as $supplier) {

            $discount_groups = SupplierBaseDiscountGroup::where('supplier_uuid','=',$supplier->uuid)->get();

            foreach ($discount_groups as $discount_group) {
                $discounts = SupplierBaseDiscountGroupDetail::where('supplier_base_discount_group_uuid','=',$discount_group->uuid)->get();
                $discount_group->discounts = $discounts;
            }

            $selected = SupplierBaseDiscountGroupItem::where('item_uuid','=',$item_uuid)->where('supplier_uuid','=',$supplier->uuid)->first();
            $supplier->selected_discount_group_uuid = ($selected) ? $selected->supplier_base_discount_group_uuid : '0';
            $supplier->selected_discount_group  = null;

            if ($selected) {
                $selected_discount_group = SupplierBaseDiscountGroup::find($supplier->selected_discount_group_uuid );
                $selected_discount_group->discounts = SupplierBaseDiscountGroupDetail::where('supplier_base_discount_group_uuid','=',$selected_discount_group->uuid)->get();
                $supplier->selected_discount_group  = $selected_discount_group;
            }
            
            
            $supplier->discount_groups = $discount_groups;
        }
        

        return response()->json(['success' => 1, 'rows' => $suppliers], 200);
    }

    public function save($supplierUUID)
    {
        $discountGroup = request()->uuid ? SupplierBaseDiscountGroup::find(request()->uuid) : new SupplierBaseDiscountGroup();

        $discountGroup->supplier_uuid = $supplierUUID;
        $discountGroup->group_name = request()->group_name;
        $discountGroup->save();
        
        $discountGroup = SupplierBaseDiscountGroup::find($discountGroup->uuid);

        return response()->json(['success' => 1, 'data' => $discountGroup], 200);
    }

    public function delete()
    {
        $discountGroup = SupplierBaseDiscountGroup::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}