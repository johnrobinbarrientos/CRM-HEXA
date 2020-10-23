<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyChartOfAccountReportGroup; 
use Illuminate\Support\Facades\Auth; 

class CompanyCOAReportGroupController extends Controller
{
    public function getReportGroup()
    {
        $list = CompanyChartOfAccountReportGroup::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('coa_report_name','LIKE','%'.$keyword.'%');
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