<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyChartOfAccounts; 
use Illuminate\Support\Facades\Auth; 

class CompanyChartOfAccountController extends Controller
{
    public function getAllChartOfAccounts()
    {
        $chartOfAccounts = CompanyChartOfAccounts::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $chartOfAccounts], 200);
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