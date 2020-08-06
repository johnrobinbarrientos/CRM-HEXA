<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierGroup; 
use Illuminate\Support\Facades\Auth; 

class SupplierGroupController extends Controller
{
    public function getSupplierGroup()
    {
        $supplierGroup = SupplierGroup::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $supplierGroup], 200);
    }

    public function save()
    {
        $supplierGroup = request()->uuid ? SupplierGroup::find(request()->uuid) : new SupplierGroup();
        $auth = \Auth::user();
        $supplierGroup->company_id = $auth->company_id;
        $supplierGroup->group_name = request()->group_name;
        $supplierGroup->save();

        $supplierGroup = SupplierGroup::find($supplierGroup->uuid);

        return response()->json(['success' => 1, 'rows' => $supplierGroup], 200);
    }

    public function delete()
    {
        $supplierGroup = SupplierGroup::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Supplier Group Deleted!'], 200);
    }
}