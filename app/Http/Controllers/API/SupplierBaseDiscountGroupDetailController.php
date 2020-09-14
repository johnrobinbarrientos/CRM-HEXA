<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierList; 
use App\Models\SupplierBaseDiscountGroup; 
use App\Models\SupplierBaseDiscountGroupDetail; 
use Illuminate\Support\Facades\Auth; 

class SupplierBaseDiscountGroupDetailController extends Controller
{
    public function getSupplierBaseDiscountGroupDetails($supplierDiscountGroupUUID)
    {
        $discount_groups = SupplierBaseDiscountGroupDetail::where('supplier_base_discount_group_uuid','=',$supplierDiscountGroupUUID)->get();
        return response()->json(['success' => 1, 'rows' => $discount_groups], 200);
    }

    public function save($supplierDiscountGroupUUID)
    {
        $data = request()->uuid ? SupplierBaseDiscountGroupDetail::find(request()->uuid) : new SupplierBaseDiscountGroupDetail();
        $auth = \Auth::user();
        $data->company_id = $auth->company_id;
        $data->supplier_base_discount_group_uuid = $supplierDiscountGroupUUID;
        $data->discount_name = request()->discount_name;
        $data->discount_rate = request()->discount_rate;
        $data->save();

        $data = SupplierBaseDiscountGroupDetail::find($data->uuid);

        return response()->json(['success' => 1, 'data' => $data], 200);
    }

    public function delete()
    {
        $data = SupplierBaseDiscountGroupDetail::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}