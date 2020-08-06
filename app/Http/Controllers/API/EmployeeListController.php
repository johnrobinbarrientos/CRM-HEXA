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
        $list = EmployeeList::whereNull('deleted_at')->with('BranchLocation')->get();
        return response()->json(['success' => 1, 'rows' => $list], 200);
    }

    public function save()
    {
        $employee = request()->uuid ? EmployeeList::find(request()->uuid) : new EmployeeList();
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
        $employee->date_hired = request()->date_hired;
        $employee->date_regularized = request()->date_regularized;
        $employee->date_terminated = request()->date_terminated;
        $employee->is_min_wage = request()->is_min_wage;
        $employee->daily_wage = request()->daily_wage;
        $employee->cost_center_uuid = request()->cost_center_uuid;
        $employee->is_applied_tax = request()->is_applied_tax;
        $employee->wt_uuid = request()->wt_uuid;
        $employee->tax_id = request()->tax_id;
        $employee->sss_id = request()->sss_id;
        $employee->phic_id = request()->phic_id;
        $employee->hdmf_id = request()->hdmf_id;
        $employee->global_address_uuid = request()->global_address_uuid;
        $employee->address1 = request()->address1;

        $employee->save();

        $employee = EmployeeList::find($employee->uuid);

        return response()->json(['success' => 1, 'rows' => $employee], 200);
    }
    public function delete()
    {
        $employee = EmployeeList::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}