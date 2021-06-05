<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 


use App\Models\ProjectList;
use App\Models\ProjectScope;
use App\Models\ProjectScopeDetail;

use App\Models\CustomerList;
use App\Models\CompanyBranch;
use App\Models\CompanyBranchLocation;

use App\Models\PurchaseBilling; 
use App\Models\PurchaseBillingExpense;
use App\Models\PurchaseBillingProject;
use App\Models\PurchaseBillingProjectExpense;

use App\Models\CompanyChartOfAccount; 

use App\Models\CompanyList;

class SellAndCollectBillController extends Controller
{

    public function draft()
    {
        $formdata = (object) request()->all(); 
        
        $customer = CustomerList::find($formdata->customer_uuid);
        $branch_location = CompanyBranchLocation::find($formdata->branch_location_uuid);
        $branch = CompanyBranch::find($formdata->branch_uuid);
        $project = ProjectList::find($formdata->project_uuid);

        $data = ['id' => null, 'uuid' => null, 'customer' => $customer, 'branch_location' => $branch_location,'branch' => $branch, 'project' => $project];
        $bill = (object) $data;

        return response()->json(['success' => 1, 'data' => $bill], 200);
        
    }

    public function getProjectExpenses($projectUUID)
    {

        $projectexpenses = PurchaseBillingProjectExpense::where('project_uuid','=',$projectUUID)->get()->makeHidden('attribute')->toArray();


        $x = 0;
                
        foreach ($projectexpenses as $expense) {
            $expense = (object) $expense;
            $expenses[$x]['purchaseBilling'] = PurchaseBilling::find($expense->purchase_billing_uuid)->makeHidden('attribute')->toArray();
            $expenses[$x]['coa'] = CompanyChartOfAccount::find($expense->coa_uuid)->makeHidden('attribute')->toArray();
            $expenses[$x]['project'] = ProjectList::find($expense->project_uuid)->makeHidden('attribute')->toArray();
            $expenses[$x]['projectScope'] = ProjectScope::find($expense->project_scope_uuid)->makeHidden('attribute')->toArray();
            $expenses[$x]['scopeDetail'] = ProjectScopeDetail::find($expense->scope_details_uuid)->makeHidden('attribute')->toArray();
            $expenses[$x]['purchase_billing_uuid'] = $expense->purchase_billing_uuid;
            $expenses[$x]['amount'] = $expense->amount;
            $expenses[$x]['memo_1'] = $expense->memo_1;
            $x++;
        }
        
        return response()->json(['success' => 1, 'rows' => $expenses], 200);
    }
    

    public function getCompanyPrefix()
    {
        $auth = \Auth::user();
        $prefix = CompanyList::whereNull('deleted_at')
        ->pluck('prefix')
        ->first();

        return $prefix;
    }



}