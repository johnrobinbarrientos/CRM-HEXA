<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyDepartment; 
use Illuminate\Support\Facades\Auth; 

class CompanyDepartmentController extends Controller
{
    public function getDepartment()
    {
        $list = CompanyDepartment::whereNull('deleted_at')->with('GlobalCostCenter');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('department','LIKE','%'.$keyword.'%');
            });
        }

        $count = $list->count();

        // pagination
        $take = (is_numeric(request()->take) && request()->take <= 100) ? request()->take: 20;
        $page = (is_numeric(request()->page)) ? request()->page : 1;
        $offset = (($page - 1 ) * $take);

        $list = $list->take($take);
        $list = $list->offset($offset);
        $list = $list->get();

        return response()->json(['success' => 1, 'rows' => $list, 'count' => $count], 200);
    }

    public function save()
    {
        $department = request()->uuid ? CompanyDepartment::find(request()->uuid) : new CompanyDepartment();
        $auth = \Auth::user();
        $department->company_id = $auth->company_id;
        $department->department = request()->department;
        $department->global_cost_center_uuid = request()->global_cost_center_uuid;
        $department->save();

        $department = CompanyDepartment::find($department->uuid);

        return response()->json(['success' => 1, 'rows' => $department], 200);
    }
    public function delete()
    {
        $department = CompanyDepartment::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}