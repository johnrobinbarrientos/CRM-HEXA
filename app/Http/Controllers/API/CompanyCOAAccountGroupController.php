<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyChartOfAccountAccountGroup; 
use Illuminate\Support\Facades\Auth; 

class CompanyCOAAccountGroupController extends Controller
{
    public function getAccountGroup()
    {
        $accountGroup = CompanyChartOfAccountAccountGroup::whereNull('deleted_at')->with('ReportGroup')->get();
        return response()->json(['success' => 1, 'rows' => $accountGroup], 200);
    }

    public function save()
    {
        $accountGroup = request()->uuid ? CompanyChartOfAccountAccountGroup::find(request()->uuid) : new CompanyChartOfAccountAccountGroup();
        $auth = \Auth::user();
        $accountGroup->company_id = $auth->company_id;
        $accountGroup->coa_report_uuid = request()->coa_report_uuid;
        $accountGroup->account_group = request()->account_group;
        $accountGroup->save();

        $accountGroup = CompanyChartOfAccountAccountGroup::find($accountGroup->uuid);

        return response()->json(['success' => 1, 'rows' => $accountGroup], 200);
    }

    public function delete()
    {
        $accountGroup = CompanyChartOfAccountAccountGroup::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Company Account Group Deleted!'], 200);
    }
}