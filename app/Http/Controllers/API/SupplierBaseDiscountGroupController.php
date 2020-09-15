<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemSupplierDiscount; 
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
        

        $suppliers = SupplierList::where('company_id','=',$auth->company_id)->whereIn('uuid',$supplier_ids)->get();

        foreach ($suppliers as $supplier) {

            $discount_groups = SupplierBaseDiscountGroup::where('supplier_uuid','=',$supplier->uuid)->get();

            foreach ($discount_groups as $discount_group) {
                $discounts = SupplierBaseDiscountGroupDetail::where('supplier_base_discount_group_uuid','=',$discount_group->uuid)->get();
                $discount_group->discounts = $discounts;
                
                $selected = ItemSupplierDiscount::where('item_uuid','=',$item_uuid)->where('supplier_base_discount_group_uuid','=',$discount_group->uuid)->first();

                $discount_group->selected = ($selected) ? true : false;

            }

            $supplier->discount_groups = $discount_groups;
        }
        

        return response()->json(['success' => 1, 'rows' => $suppliers], 200);
    }

    public function save($supplierUUID)
    {
        $discountGroup = request()->uuid ? SupplierBaseDiscountGroup::find(request()->uuid) : new SupplierBaseDiscountGroup();
        $auth = \Auth::user();
        $discountGroup->company_id = $auth->company_id;
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