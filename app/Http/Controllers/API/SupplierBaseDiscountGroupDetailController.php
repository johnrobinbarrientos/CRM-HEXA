<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierBaseDiscountGroupDetail; 
use Illuminate\Support\Facades\Auth; 

class SupplierBaseDiscountGroupDetailController extends Controller
{
    public function getSupplierBaseDiscountGroupDetails()
    {
        $groupDetails = SupplierBaseDiscountGroupDetail::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $groupDetails], 200);
    }

    public function save()
    {
        $groupDetails = request()->uuid ? SupplierBaseDiscountGroupDetail::find(request()->uuid) : new SupplierBaseDiscountGroupDetail();
        $auth = \Auth::user();
        $groupDetails->company_id = $auth->company_id;
        $groupDetails->supplier_base_discount_group_uuid = request()->supplier_base_discount_group_uuid;
        $groupDetails->discount_name = request()->discount_name;
        $groupDetails->discount_rate = request()->discount_rate;
        $groupDetails->save();

        $groupDetails = SupplierBaseDiscountGroupDetail::find($groupDetails->uuid);

        return response()->json(['success' => 1, 'rows' => $groupDetails], 200);
    }

    public function delete()
    {
        $groupDetails = SupplierBaseDiscountGroupDetail::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}