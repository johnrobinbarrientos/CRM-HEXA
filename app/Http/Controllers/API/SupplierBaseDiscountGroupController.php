<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierBaseDiscountGroup; 
use Illuminate\Support\Facades\Auth; 

class SupplierBaseDiscountGroupController extends Controller
{
    public function getSupplierBaseDiscountGroup()
    {
        $discountGroup = SupplierBaseDiscountGroup::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $discountGroup], 200);
    }

    public function save()
    {
        $discountGroup = request()->uuid ? SupplierBaseDiscountGroup::find(request()->uuid) : new SupplierBaseDiscountGroup();
        $auth = \Auth::user();
        $discountGroup->company_id = $auth->company_id;
        $discountGroup->supplier_uuid = request()->supplier_uuid;
        $discountGroup->group_name = request()->group_name;
        $discountGroup->save();

        $discountGroup = SupplierBaseDiscountGroup::find($discountGroup->uuid);

        return response()->json(['success' => 1, 'rows' => $discountGroup], 200);
    }

    public function delete()
    {
        $discountGroup = SupplierBaseDiscountGroup::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}