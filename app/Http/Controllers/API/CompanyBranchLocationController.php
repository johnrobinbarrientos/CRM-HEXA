<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyBranchLocation; 
use Illuminate\Support\Facades\Auth; 

class CompanyBranchLocationController extends Controller
{
    public function getAllBranchLocation()
    {
        $branchLocation = CompanyBranchLocation::whereNull('deleted_at')->with('branch')->get();
        return response()->json(['success' => 1, 'rows' => $branchLocation], 200);
    }

    public function save()
    {
        $branchLocation = request()->uuid ? CompanyBranchLocation::find(request()->uuid) : new CompanyBranchLocation();
        $auth = \Auth::user();
        $branchLocation->company_id = $auth->company_id;
        $branchLocation->branch_uuid = request()->branch_uuid;
        $branchLocation->location_name = request()->location_name;
        $branchLocation->location_shortname = request()->location_shortname;
        $branchLocation->save();

        $branchLocation = CompanyBranchLocation::find($branchLocation->uuid);

        return response()->json(['success' => 1, 'rows' => $branchLocation], 200);
    }

    public function delete()
    {
        $branchLocation = CompanyBranchLocation::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Branch Location Deleted!'], 200);
    }
}