<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\AdminChartOfAccountReportGroup; 
use Illuminate\Support\Facades\Auth; 

class AdminCOAReportGroupController extends Controller
{
    public function getReportGroup()
    {
        $reportGroup = AdminChartOfAccountReportGroup::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $reportGroup], 200);
    }

    public function save()
    {
        $reportGroup = request()->uuid ? AdminChartOfAccountReportGroup::find(request()->uuid) : new AdminChartOfAccountReportGroup();
        $reportGroup->coa_report_name = request()->coa_report_name;
        $reportGroup->save();

        $reportGroup = AdminChartOfAccountReportGroup::find($reportGroup->uuid);

        return response()->json(['success' => 1, 'rows' => $reportGroup], 200);
    }

    public function delete()
    {
        $reportGroup = AdminChartOfAccountReportGroup::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'COA Report Group Deleted!'], 200);
    }
}