<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyChartOfAccount; 
use App\Models\CompanyChartOfAccountAccountGroup; 
use Illuminate\Support\Facades\Auth;
use DB; 

class CompanyChartOfAccountController extends Controller
{
    public function getChartOfAccounts()
    {
        $list = CompanyChartOfAccount::whereNull('deleted_at')->with('AccountGroup');
        
        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('account_name','LIKE','%'.$keyword.'%');
            });
        }

        if (!empty(request()->group)) {
            $group_name = explode(',',request()->group);
            $group_uuids = CompanyChartOfAccountAccountGroup::where('account_group','=',$group_name)->pluck('uuid')->toArray();
            $list->whereIn('coa_group_uuid',$group_uuids);
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
        $chartOfAccounts = request()->uuid ? CompanyChartOfAccount::find(request()->uuid) : new CompanyChartOfAccount();

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

    public function getPayables()
    {

        $payables = CompanyChartOfAccount::select('company_chart_of_accounts.uuid','account_name')
        ->leftJoin('company_chart_of_accounts_account_group', 'company_chart_of_accounts.coa_group_uuid', '=', 'company_chart_of_accounts_account_group.uuid')
        ->where('account_group','Accounts Payable')
        ->get();

        return response()->json(['success' => 1, 'rows' => $payables], 200);
    }

    public function getIncomeAccount()
    {

        $income = CompanyChartOfAccount::select('company_chart_of_accounts.uuid','account_name')
        ->leftJoin('company_chart_of_accounts_account_group', 'company_chart_of_accounts.coa_group_uuid', '=', 'company_chart_of_accounts_account_group.uuid')
        ->where('account_group','Income')
        ->get();

        return response()->json(['success' => 1, 'rows' => $income], 200);
    }

    public function getCostOfSales()
    {
        $cos = CompanyChartOfAccount::select('company_chart_of_accounts.uuid','account_name')
        ->leftJoin('company_chart_of_accounts_account_group', 'company_chart_of_accounts.coa_group_uuid', '=', 'company_chart_of_accounts_account_group.uuid')
        ->where('account_group','Cost of Sales')
        ->get();

        return response()->json(['success' => 1, 'rows' => $cos], 200);
    }

    public function getRecievables()
    {
        $recievables = CompanyChartOfAccount::select('company_chart_of_accounts.uuid','account_name')
        ->leftJoin('company_chart_of_accounts_account_group', 'company_chart_of_accounts.coa_group_uuid', '=', 'company_chart_of_accounts_account_group.uuid')
        ->where('account_group','Receivable')
        ->get();

        return response()->json(['success' => 1, 'rows' => $recievables], 200);
    }


}