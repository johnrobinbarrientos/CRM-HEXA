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
        $list = SupplierBaseDiscountGroup::where('supplier_uuid','=',$supplierUUID);

        if (!empty(request()->discounts) && request()->discounts == 'yes') {
            $list = $list->with('SupplierBaseDiscountGroupDetails');
        }
      
        $list = $list->get();

        return response()->json(['success' => 1, 'rows' => $list], 200);
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
        $data = request()->all();
        $discounts = (is_array($data['supplier_base_discount_group_details'])) ? $data['supplier_base_discount_group_details'] : [];


        $errors = 0;

        $data['group_name_error'] = false;
        if (empty($data['group_name'])) {
            $data['group_name_error'] = true;
            $errors++;
        }

        $discount_uuids = [];
        foreach ($discounts as $key=> $discount) {
            
            $discount['discount_name_error'] = false;
            $discount['discount_rate_error'] = false;
            
            $discount_uuids[] = $discount['uuid'];

            if (empty($discount['discount_name'])) {
                $discount['discount_name_error'] = true;
                $errors++;
            }

            if (empty($discount['discount_rate']) || $discount['discount_rate'] <= 0) {
                $discount['discount_rate_error'] = true;
                $errors++;
            }

            $discounts[$key] = $discount;
        }
    
      
        if ($errors) {
            $data['supplier_base_discount_group_details'] = $discounts;
            return response()->json(['success' => 0, 'data' => $data ], 500);
        }

        $discountGroup = request()->uuid ? SupplierBaseDiscountGroup::find(request()->uuid) : new SupplierBaseDiscountGroup();
        $discountGroup->supplier_uuid = $supplierUUID;
        $discountGroup->group_name = request()->group_name;
        $discountGroup->save();

        $delete = SupplierBaseDiscountGroupDetail::where('supplier_base_discount_group_uuid','=',$discountGroup->uuid)->whereNotIn('uuid',$discount_uuids)->delete();

        foreach ($discounts as $discount) {
            
            $uuid = ($discount['uuid']) ? $discount['uuid'] : '';
            $data = SupplierBaseDiscountGroupDetail::find($uuid);
            $data = ($data) ? $data : new SupplierBaseDiscountGroupDetail;

            $data->supplier_base_discount_group_uuid = $discountGroup->uuid;
            $data->discount_name = $discount['discount_name'];
            $data->discount_rate = $discount['discount_rate'];
            $data->save();
        }
        
        $discountGroup = SupplierBaseDiscountGroup::with('SupplierBaseDiscountGroupDetails')->find($discountGroup->uuid);

        
        return response()->json(['success' => 1, 'data' => $discountGroup], 200);
    }

    public function delete($supplierUUID,$supplierBaseDiscountGroupUUID)
    {
        $discountGroup = SupplierBaseDiscountGroup::find($supplierBaseDiscountGroupUUID)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}