<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\EmployeeEmploymentType; 
use Illuminate\Support\Facades\Auth; 

class EmployeeEmploymentTypeController extends Controller
{
    public function getEmploymentType()
    {
        $list = EmployeeEmploymentType::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('employment_type','LIKE','%'.$keyword.'%');
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
        $employmentType = request()->uuid ? EmployeeEmploymentType::find(request()->uuid) : new EmployeeEmploymentType();

        $employmentType->employment_type = request()->employment_type;
        $employmentType->save();

        $employmentType = EmployeeEmploymentType::find($employmentType->uuid);

        return response()->json(['success' => 1, 'rows' => $employmentType], 200);
    }
    public function delete()
    {
        $employmentType = EmployeeEmploymentType::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Employment Type Deleted!'], 200);
    }
}