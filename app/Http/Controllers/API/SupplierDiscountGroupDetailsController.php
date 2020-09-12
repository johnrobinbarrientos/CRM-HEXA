<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierDiscountGroupDetails; 
use Illuminate\Support\Facades\Auth; 

class SupplierDiscountGroupDetailsController extends Controller
{
    public function getSupplierDiscountGroupDetails()
    {
        $groupDetails = SupplierDiscountGroupDetails::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $groupDetails], 200);
    }

    public function save()
    {
        $groupDetails = request()->uuid ? SupplierDiscountGroupDetails::find(request()->uuid) : new SupplierDiscountGroupDetails();
        $auth = \Auth::user();
        $groupDetails->company_id = $auth->company_id;
        $groupDetails->supplier_discount_group_uuid = request()->supplier_discount_group_uuid;
        $groupDetails->discount_name = request()->discount_name;
        $groupDetails->discount_rate = request()->discount_rate;
        $groupDetails->save();

        $groupDetails = SupplierDiscountGroupDetails::find($groupDetails->uuid);

        return response()->json(['success' => 1, 'rows' => $groupDetails], 200);
    }

    public function delete()
    {
        $groupDetails = SupplierDiscountGroupDetails::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}