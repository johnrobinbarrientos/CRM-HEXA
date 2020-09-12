<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierBaseDiscountGroupDetails; 
use Illuminate\Support\Facades\Auth; 

class SupplierBaseDiscountGroupDetailsController extends Controller
{
    public function getSupplierBaseDiscountGroupDetails()
    {
        $groupDetails = SupplierBaseDiscountGroupDetails::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $groupDetails], 200);
    }

    public function save()
    {
        $groupDetails = request()->uuid ? SupplierBaseDiscountGroupDetails::find(request()->uuid) : new SupplierBaseDiscountGroupDetails();
        $auth = \Auth::user();
        $groupDetails->company_id = $auth->company_id;
        $groupDetails->supplier_base_discount_group_uuid = request()->supplier_base_discount_group_uuid;
        $groupDetails->discount_name = request()->discount_name;
        $groupDetails->discount_rate = request()->discount_rate;
        $groupDetails->save();

        $groupDetails = SupplierBaseDiscountGroupDetails::find($groupDetails->uuid);

        return response()->json(['success' => 1, 'rows' => $groupDetails], 200);
    }

    public function delete()
    {
        $groupDetails = SupplierBaseDiscountGroupDetails::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}