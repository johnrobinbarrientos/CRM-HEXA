<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\AdminChartOfAccountAccountGroup; 
use Illuminate\Support\Facades\Auth; 

class AdminCOAAccountGroupController extends Controller
{
    public function getAccountGroup()
    {
        $list = AdminChartOfAccountAccountGroup::whereNull('deleted_at')->with('ReportGroup');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('account_group','LIKE','%'.$keyword.'%');
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
        $accountGroup = request()->uuid ? AdminChartOfAccountAccountGroup::find(request()->uuid) : new AdminChartOfAccountAccountGroup();
        $accountGroup->coa_report_uuid = request()->coa_report_uuid;
        $accountGroup->account_group = request()->account_group;
        $accountGroup->save();

        $accountGroup = AdminChartOfAccountAccountGroup::find($accountGroup->uuid);

        return response()->json(['success' => 1, 'rows' => $accountGroup], 200);
    }

    public function delete()
    {
        $accountGroup = AdminChartOfAccountAccountGroup::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Account Group Deleted!'], 200);
    }
}