<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\AdminChartOfAccount; 
use Illuminate\Support\Facades\Auth;
use DB; 

class AdminChartOfAccountController extends Controller
{
    public function getAccounts()
    {
        $chartOfAccounts = AdminChartOfAccount::whereNull('deleted_at')->with('AccountGroup')->get();
        return response()->json(['success' => 1, 'rows' => $chartOfAccounts], 200);
    }

    public function save()
    {
        $chartOfAccounts = request()->uuid ? AdminChartOfAccount::find(request()->uuid) : new AdminChartOfAccount();
        $chartOfAccounts->code = request()->code;
        $chartOfAccounts->account_name = request()->account_name;
        $chartOfAccounts->coa_group_uuid = request()->coa_group_uuid;
        $chartOfAccounts->save();

        $chartOfAccounts = AdminChartOfAccount::find($chartOfAccounts->uuid);

        return response()->json(['success' => 1, 'rows' => $chartOfAccounts], 200);
    }

    public function delete()
    {
        $chartOfAccounts = AdminChartOfAccount::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Chart Of Accounts Deleted!'], 200);
    }
}