<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\EmployeeEmploymentType; 
use Illuminate\Support\Facades\Auth; 

class EmployeeEmploymentTypeController extends Controller
{
    public function getAllEmploymentType()
    {
        $employmentType = EmployeeEmploymentType::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $employmentType], 200);
    }

    public function save()
    {
        $employmentType = new EmployeeEmploymentType();
        $auth = \Auth::user();
        $employmentType->company_id = $auth->company_id;
        $employmentType->employment_type = request()->employment_type;
        $employmentType->save();

        $employmentType = EmployeeEmploymentType::find($employmentType->uuid);
        return response()->json(['success' => 1, 'data' => $employmentType, 'message' => 'Employment Type Added!'], 200); 
    }


    public function update()
    {
        $employmentType = EmployeeEmploymentType::find(request()->uuid);

        if (!$employmentType) {
            return response()->json(['success' => 0, 'message' => 'Could not find Employment Type!'], 200);
        }

        $employmentType->employment_type = request()->employment_type;
        $employmentType->save();
        
        return response()->json(['success' => 1, 'data' => $employmentType, 'message' => 'Employment Type Updated!'], 200); 
    }

    public function delete()
    {
        $employmentType = EmployeeEmploymentType::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Employment Type Deleted!'], 200);
    }
}