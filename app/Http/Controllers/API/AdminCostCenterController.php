<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\AdminCostCenter; 
use Illuminate\Support\Facades\Auth; 

class AdminCostCenterController extends Controller
{
    public function getCostCenter()
    {
        $costCenter = AdminCostCenter::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $costCenter], 200);
    }

    public function save()
    {
        $costCenter = request()->uuid ? AdminCostCenter::find(request()->uuid) : new AdminCostCenter();
        $costCenter->cost_center_name = request()->cost_center_name;
        $costCenter->cost_center_shortname = request()->cost_center_shortname;
        $costCenter->is_group = request()->is_group;
        $costCenter->cost_center_group = request()->cost_center_group;
        $costCenter->save();

        $costCenter = AdminCostCenter::find($costCenter->uuid);

        return response()->json(['success' => 1, 'rows' => $costCenter], 200);
    }

    public function delete()
    {
        $costCenter = AdminCostCenter::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Cost Center Deleted!'], 200);
    }
}