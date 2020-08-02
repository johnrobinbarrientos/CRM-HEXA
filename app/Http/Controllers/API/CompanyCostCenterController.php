<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyCostCenter; 
use Illuminate\Support\Facades\Auth; 

class CompanyCostCenterController extends Controller
{
    public function getAllCostCenter()
    {
        $companyCostCenter = CompanyCostCenter::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $companyCostCenter], 200);
    }

    public function save()
    {
        $companyCostCenter = request()->uuid ? CompanyCostCenter::find(request()->uuid) : new CompanyCostCenter();
        $auth = \Auth::user();
        $companyCostCenter->company_id = $auth->company_id;
        $companyCostCenter->cost_center_name = request()->cost_center_name;
        $companyCostCenter->cost_center_shortname = request()->cost_center_shortname;
        $companyCostCenter->is_group = request()->is_group;
        $companyCostCenter->cost_center_group = request()->cost_center_group;
        $companyCostCenter->save();

        $companyCostCenter = CompanyCostCenter::find($companyCostCenter->uuid);

        return response()->json(['success' => 1, 'rows' => $companyCostCenter], 200);
    }

    public function delete()
    {
        $companyCostCenter = CompanyCostCenter::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Company Cost Center Deleted!'], 200);
    }
}