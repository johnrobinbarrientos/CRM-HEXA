<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyChartOfAccounts; 
use Illuminate\Support\Facades\Auth;
use DB; 

class CompanyChartOfAccountController extends Controller
{
    public function getAllChartOfAccounts()
    {
        $chartOfAccounts = CompanyChartOfAccounts::whereNull('deleted_at')->with('AccountGroup')->get();
        return response()->json(['success' => 1, 'rows' => $chartOfAccounts], 200);
    }

    public function getAllPayables()
    {

        $payables = CompanyChartOfAccounts::select('company_chart_of_accounts.uuid','account_name')
        ->leftJoin('company_chart_of_accounts_account_group', 'company_chart_of_accounts.coa_group_uuid', '=', 'company_chart_of_accounts_account_group.uuid')
        ->where('account_group','Payable')
        ->get();

        return response()->json(['success' => 1, 'rows' => $payables], 200);
    }

    public function getAllIncomeAccount()
    {

        $income = CompanyChartOfAccounts::select('company_chart_of_accounts.uuid','account_name')
        ->leftJoin('company_chart_of_accounts_account_group', 'company_chart_of_accounts.coa_group_uuid', '=', 'company_chart_of_accounts_account_group.uuid')
        ->where('account_group','income')
        ->get();

        return response()->json(['success' => 1, 'rows' => $income], 200);
    }

    public function getAllCostOfSales()
    {
        $cos = CompanyChartOfAccounts::select('company_chart_of_accounts.uuid','account_name')
        ->leftJoin('company_chart_of_accounts_account_group', 'company_chart_of_accounts.coa_group_uuid', '=', 'company_chart_of_accounts_account_group.uuid')
        ->where('account_group','Cost of sales')
        ->get();

        return response()->json(['success' => 1, 'rows' => $cos], 200);
    }

    public function save()
    {
        $chartOfAccounts = new CompanyChartOfAccounts();
        $auth = \Auth::user();
        $chartOfAccounts->company_id = $auth->company_id;
        $chartOfAccounts->code = request()->code;
        $chartOfAccounts->account_name = request()->account_name;
        $chartOfAccounts->coa_group_uuid = request()->coa_group_uuid;
        $chartOfAccounts->save();

        $chartOfAccounts = CompanyChartOfAccounts::find($chartOfAccounts->uuid);
        return response()->json(['success' => 1, 'data' => $chartOfAccounts, 'message' => 'Chart Of Accounts Added!'], 200); 
    }


    public function update()
    {
        $chartOfAccounts = CompanyChartOfAccounts::find(request()->uuid);

        if (!$chartOfAccounts) {
            return response()->json(['success' => 0, 'message' => 'Could not find Chart Of Accounts!'], 200);
        }

        $chartOfAccounts->code = request()->code;
        $chartOfAccounts->account_name = request()->account_name;
        $chartOfAccounts->coa_group_uuid = request()->coa_group_uuid;
        $chartOfAccounts->save();
        
        return response()->json(['success' => 1, 'data' => $chartOfAccounts, 'message' => 'Chart Of Accounts Updated!'], 200); 
    }

    public function delete()
    {
        $chartOfAccounts = CompanyChartOfAccounts::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Chart Of Accounts Deleted!'], 200);
    }
}