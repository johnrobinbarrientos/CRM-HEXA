<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierDiscountGroup; 
use Illuminate\Support\Facades\Auth; 

class SupplierDiscountGroupController extends Controller
{
    public function getSupplierDiscountGroup()
    {
        $discountGroup = SupplierDiscountGroup::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $discountGroup], 200);
    }

    public function save()
    {
        $discountGroup = request()->uuid ? SupplierDiscountGroup::find(request()->uuid) : new SupplierDiscountGroup();
        $auth = \Auth::user();
        $discountGroup->company_id = $auth->company_id;
        $discountGroup->supplier_uuid = request()->supplier_uuid;
        $discountGroup->group_name = request()->group_name;
        $discountGroup->save();

        $discountGroup = SupplierDiscountGroup::find($discountGroup->uuid);

        return response()->json(['success' => 1, 'rows' => $discountGroup], 200);
    }

    public function delete()
    {
        $discountGroup = SupplierDiscountGroup::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}