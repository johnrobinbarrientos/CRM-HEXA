<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 


use App\Models\ProjectList;
use App\Models\CustomerList;
use App\Models\CompanyBranch;
use App\Models\CompanyBranchLocation;

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
    

    public function getCompanyPrefix()
    {
        $auth = \Auth::user();
        $prefix = CompanyList::whereNull('deleted_at')
        ->pluck('prefix')
        ->first();

        return $prefix;
    }



}