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
        $branchLocation = new CompanyBranchLocation();
        $auth = \Auth::user();
        $branchLocation->company_id = $auth->company_id;
        $branchLocation->branch_uuid = request()->branch_uuid;
        $branchLocation->location_name = request()->location_name;
        $branchLocation->location_shortname = request()->location_shortname;
        $branchLocation->save();

        $branchLocation = CompanyBranchLocation::find($branchLocation->uuid);
        return response()->json(['success' => 1, 'data' => $branchLocation, 'message' => 'Branch Location Added!'], 200); 
    }


    public function update()
    {
        $branchLocation = CompanyBranchLocation::find(request()->uuid);

        if (!$branchLocation) {
            return response()->json(['success' => 0, 'message' => 'Could not find Branch Location!'], 200);
        }

        $branchLocation->branch_uuid = request()->branch_uuid;
        $branchLocation->location_name = request()->location_name;
        $branchLocation->location_shortname = request()->location_shortname;
        $branchLocation->save();
        
        return response()->json(['success' => 1, 'data' => $branchLocation, 'message' => 'Branch Location Updated!'], 200); 
    }

    public function delete()
    {
        $branchLocation = CompanyBranchLocation::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Branch Location Deleted!'], 200);
    }
}