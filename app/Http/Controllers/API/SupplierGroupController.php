<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierGroup; 
use Illuminate\Support\Facades\Auth; 

class SupplierGroupController extends Controller
{
    public function getAllSupplierGroup()
    {
        $supplierGroup = SupplierGroup::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $supplierGroup], 200);
    }

    public function save()
    {
        $supplierGroup = new SupplierGroup();
        $auth = \Auth::user();
        $supplierGroup->company_id = $auth->company_id;
        $supplierGroup->group_name = request()->group_name;
        $supplierGroup->save();

        $supplierGroup = SupplierGroup::find($supplierGroup->uuid);
        return response()->json(['success' => 1, 'data' => $supplierGroup, 'message' => 'Supplier Group Added!'], 200); 
    }


    public function update()
    {
        $supplierGroup = SupplierGroup::find(request()->uuid);

        if (!$supplierGroup) {
            return response()->json(['success' => 0, 'message' => 'Could not find Supplier Group!'], 200);
        }

        $supplierGroup->group_name = request()->group_name;
        $supplierGroup->save();
        
        return response()->json(['success' => 1, 'data' => $supplierGroup, 'message' => 'Supplier Group Updated!'], 200); 
    }

    public function delete()
    {
        $supplierGroup = SupplierGroup::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Supplier Group Deleted!'], 200);
    }
}