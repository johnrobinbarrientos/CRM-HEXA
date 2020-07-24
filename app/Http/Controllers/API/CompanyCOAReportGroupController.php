<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyChartOfAccountsReportGroup; 
use Illuminate\Support\Facades\Auth; 

class CompanyCOAReportGroupController extends Controller
{
    public function getAllReportGroup()
    {
        $reportGroup = CompanyChartOfAccountsReportGroup::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $reportGroup], 200);
    }

    public function save()
    {
        $reportGroup = new CompanyChartOfAccountsReportGroup();
        $auth = \Auth::user();
        $reportGroup->company_id = $auth->company_id;
        $reportGroup->coa_report_name = request()->coa_report_name;
        $reportGroup->save();

        $reportGroup = CompanyChartOfAccountsReportGroup::find($reportGroup->uuid);
        return response()->json(['success' => 1, 'data' => $reportGroup, 'message' => ' COA Report Group Added!'], 200); 
    }


    public function update()
    {
        $reportGroup = CompanyChartOfAccountsReportGroup::find(request()->uuid);

        if (!$reportGroup) {
            return response()->json(['success' => 0, 'message' => 'Could not find COA Report Group!'], 200);
        }

        $reportGroup->coa_report_name = request()->coa_report_name;
        $reportGroup->save();
        
        return response()->json(['success' => 1, 'data' => $reportGroup, 'message' => 'COA Report Group Updated!'], 200); 
    }

    public function delete()
    {
        $reportGroup = CompanyChartOfAccountsReportGroup::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'COA Report Group Deleted!'], 200);
    }
}