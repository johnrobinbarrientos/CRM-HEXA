<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyBranchLocation; 
use Illuminate\Support\Facades\Auth; 

class CompanyBranchLocationController extends Controller
{
    public function getBranchLocation()
    {
        $list = CompanyBranchLocation::whereNull('deleted_at')->with('branch');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('location_name','LIKE','%'.$keyword.'%')
                ->orWhere('location_shortname','LIKE','%'.$keyword.'%');
            });
        }

        $count = $list->count();

        // pagination
        $take = (is_numeric(request()->take) && request()->take <= 50) ? request()->take: 20;
        $page = (is_numeric(request()->page)) ? request()->page : 1;
        $offset = (($page - 1 ) * $take);

        $list = $list->take($take);
        $list = $list->offset($offset);
        $list = $list->get();

        return response()->json(['success' => 1, 'rows' => $list, 'count' => $count], 200);
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