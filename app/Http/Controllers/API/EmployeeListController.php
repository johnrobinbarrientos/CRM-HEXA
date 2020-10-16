<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\EmployeeList; 
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; 

class EmployeeListController extends Controller
{
    public function getEmployeeList()
    {
        $list = EmployeeList::where('is_draft','=', 0)->whereNull('deleted_at')->with('BranchLocation');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('emp_id','LIKE','%'.$keyword.'%')
                    ->orWhere('first_name','LIKE','%'.$keyword.'%')
                    ->orWhere('middle_name','LIKE','%'.$keyword.'%')
                    ->orWhere('last_name','LIKE','%'.$keyword.'%');
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

    public function getSupervisors()
    {

        $list = EmployeeList::where('is_draft','=', 0)->whereNull('deleted_at')->where('is_supervisor', 1)->where('uuid','!=', request()->emp_uuid)
        ->get();

        return response()->json(['success' => 1, 'rows' => $list], 200);
    }

    public function store() // initialize draft
    {
        $employee =  EmployeeList::where('is_draft','=', 1)->first();

        if (!$employee) {
            $auth = \Auth::user();

            $employee = new EmployeeList();
            $employee->company_id = $auth->company_id;

            $employee->save();
        }


        $employee = EmployeeList::find($employee->uuid);
        return response()->json(['success' => 1, 'data' => $employee], 200);
    }

    public function update()
    {

        $employee =  EmployeeList::find(request()->uuid);
        
        if (!$employee) {
            return response()->json(['success' => 0, 'data' => null, 'Not found'], 500);
        }

        $auth = \Auth::user();
        $employee->company_id = $auth->company_id;
        $employee->emp_id = request()->emp_id;
        $employee->first_name = request()->first_name;
        $employee->middle_name = request()->middle_name;
        $employee->last_name = request()->last_name;
        $employee->ext = request()->ext;
        $employee->branch_location_uuid  = request()->branch_location_uuid ;
        $employee->is_custodian = request()->is_custodian;
        $employee->is_driver = request()->is_driver;
        $employee->is_system_user = request()->is_system_user;
        $employee->is_active = request()->is_active;
        $employee->email = request()->email;
        $employee->contact_no = request()->contact_no;
        $employee->emergeny_contact = request()->emergeny_contact;
        $employee->emergeny_contact_relation = request()->emergeny_contact_relation;
        $employee->relation_contact_no = request()->relation_contact_no;
        $employee->employment_type_uuid = request()->employment_type_uuid;
        $employee->employment_status_uuid = request()->employment_status_uuid;
        $employee->date_hired = request()->date_hired;
        $employee->date_regularized = request()->date_regularized;
        $employee->date_terminated = request()->date_terminated;
        $employee->is_min_wage = request()->is_min_wage;
        $employee->daily_wage = request()->daily_wage;
        $employee->global_cost_center_uuid = request()->global_cost_center_uuid;
        $employee->is_applied_tax = request()->is_applied_tax;
        $employee->wt_uuid = request()->wt_uuid;
        $employee->tax_id = request()->tax_id;
        $employee->sss_id = request()->sss_id;
        $employee->phic_id = request()->phic_id;
        $employee->hdmf_id = request()->hdmf_id;
        $employee->global_address_uuid = request()->global_address_uuid;
        $employee->address1 = request()->address1;
        $employee->job_title = request()->job_title;
        $employee->is_supervisor = request()->is_supervisor;
        $employee->date_of_birth = request()->date_of_birth;
        $employee->department_uuid = request()->department_uuid;
        $employee->supervisor_emp_uuid = request()->supervisor_emp_uuid;
        $employee->is_draft = 0;

        $employee->save();

        $employee = EmployeeList::find($employee->uuid);

        return response()->json(['success' => 1, 'rows' => $employee], 200);
    }

    public function show($employeeUUID) // set update records
    {
        $employee = EmployeeList::with('BranchLocation')->find($employeeUUID);

        if (!$employee) {
            return response()->json(['success' => 0, 'data' => null, 'Not found'], 500);
        }
        return response()->json(['success' => 1, 'data' => $employee], 200);
    }

    public function delete()
    {
        $employee = EmployeeList::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}