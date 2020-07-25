<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyChartOfAccountsAccountGroup; 
use Illuminate\Support\Facades\Auth; 

class CompanyCOAAccountGroupController extends Controller
{
    public function getAllAccountGroup()
    {
        $accountGroup = CompanyChartOfAccountsAccountGroup::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $accountGroup], 200);
    }

    public function save()
    {
        $accountGroup = new CompanyChartOfAccountsAccountGroup();
        $auth = \Auth::user();
        $accountGroup->company_id = $auth->company_id;
        $accountGroup->coa_report_uuid = request()->coa_report_uuid;
        $accountGroup->account_group = request()->account_group;
        $accountGroup->save();

        $accountGroup = CompanyChartOfAccountsAccountGroup::find($accountGroup->uuid);
        return response()->json(['success' => 1, 'data' => $accountGroup, 'message' => 'Company Account Group Added!'], 200); 
    }


    public function update()
    {
        $accountGroup = CompanyChartOfAccountsAccountGroup::find(request()->uuid);

        if (!$accountGroup) {
            return response()->json(['success' => 0, 'message' => 'Could not find Company Account Group!'], 200);
        }

        $accountGroup->coa_report_uuid = request()->coa_report_uuid;
        $accountGroup->account_group = request()->account_group;
        $accountGroup->save();
        
        return response()->json(['success' => 1, 'data' => $accountGroup, 'message' => 'Company Account Group Updated!'], 200); 
    }

    public function delete()
    {
        $accountGroup = CompanyChartOfAccountsAccountGroup::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Company Account Group Deleted!'], 200);
    }
}