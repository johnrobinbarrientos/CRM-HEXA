<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyChartOfAccount; 
use Illuminate\Support\Facades\Auth;
use DB; 

class CompanyChartOfAccountController extends Controller
{
    public function getAllChartOfAccounts()
    {
        $chartOfAccounts = CompanyChartOfAccount::whereNull('deleted_at')->with('AccountGroup')->get();
        return response()->json(['success' => 1, 'rows' => $chartOfAccounts], 200);
    }

    public function getAllPayables()
    {

        $payables = CompanyChartOfAccount::select('company_chart_of_accounts.uuid','account_name')
        ->leftJoin('company_chart_of_accounts_account_group', 'company_chart_of_accounts.coa_group_uuid', '=', 'company_chart_of_accounts_account_group.uuid')
        ->where('account_group','Payable')
        ->get();

        return response()->json(['success' => 1, 'rows' => $payables], 200);
    }

    public function getAllIncomeAccount()
    {

        $income = CompanyChartOfAccount::select('company_chart_of_accounts.uuid','account_name')
        ->leftJoin('company_chart_of_accounts_account_group', 'company_chart_of_accounts.coa_group_uuid', '=', 'company_chart_of_accounts_account_group.uuid')
        ->where('account_group','income')
        ->get();

        return response()->json(['success' => 1, 'rows' => $income], 200);
    }

    public function getAllCostOfSales()
    {
        $cos = CompanyChartOfAccount::select('company_chart_of_accounts.uuid','account_name')
        ->leftJoin('company_chart_of_accounts_account_group', 'company_chart_of_accounts.coa_group_uuid', '=', 'company_chart_of_accounts_account_group.uuid')
        ->where('account_group','Cost of sales')
        ->get();

        return response()->json(['success' => 1, 'rows' => $cos], 200);
    }

    public function save()
    {
        $chartOfAccounts = request()->uuid ? CompanyChartOfAccount::find(request()->uuid) : new CompanyChartOfAccount();
        $auth = \Auth::user();
        $chartOfAccounts->company_id = $auth->company_id;
        $chartOfAccounts->code = request()->code;
        $chartOfAccounts->account_name = request()->account_name;
        $chartOfAccounts->coa_group_uuid = request()->coa_group_uuid;
        $chartOfAccounts->save();

        $chartOfAccounts = CompanyChartOfAccount::find($chartOfAccounts->uuid);

        return response()->json(['success' => 1, 'rows' => $chartOfAccounts], 200);
    }

    public function delete()
    {
        $chartOfAccounts = CompanyChartOfAccount::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Chart Of Accounts Deleted!'], 200);
    }
}