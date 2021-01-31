<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\EmployeeEmploymentStatus; 
use Illuminate\Support\Facades\Auth; 

class EmployeeEmploymentStatusController extends Controller
{
    public function getEmploymentStatus()
    {
        $list = EmployeeEmploymentStatus::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('employment_status','LIKE','%'.$keyword.'%');
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
        $employmentStatus = request()->uuid ? EmployeeEmploymentStatus::find(request()->uuid) : new EmployeeEmploymentStatus();

        $employmentStatus->employment_status = request()->employment_status;
        $employmentStatus->save();

        $employmentStatus = EmployeeEmploymentStatus::find($employmentStatus->uuid);

        return response()->json(['success' => 1, 'rows' => $employmentStatus], 200);
    }
    public function delete()
    {
        $employmentStatus = EmployeeEmploymentStatus::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}