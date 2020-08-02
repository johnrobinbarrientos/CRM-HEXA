<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyChartOfAccountReportGroup; 
use Illuminate\Support\Facades\Auth; 

class CompanyCOAReportGroupController extends Controller
{
    public function getAllReportGroup()
    {
        $reportGroup = CompanyChartOfAccountReportGroup::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $reportGroup], 200);
    }

    public function save()
    {
        $reportGroup = request()->uuid ? CompanyChartOfAccountReportGroup::find(request()->uuid) : new CompanyChartOfAccountReportGroup();
        $auth = \Auth::user();
        $reportGroup->company_id = $auth->company_id;
        $reportGroup->coa_report_name = request()->coa_report_name;
        $reportGroup->save();

        $reportGroup = CompanyChartOfAccountReportGroup::find($reportGroup->uuid);

        return response()->json(['success' => 1, 'rows' => $reportGroup], 200);
    }

    public function delete()
    {
        $reportGroup = CompanyChartOfAccountReportGroup::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'COA Report Group Deleted!'], 200);
    }
}