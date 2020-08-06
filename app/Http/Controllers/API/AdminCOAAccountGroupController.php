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
        $accountGroup = AdminChartOfAccountAccountGroup::whereNull('deleted_at')->with('ReportGroup')->get();
        return response()->json(['success' => 1, 'rows' => $accountGroup], 200);
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