<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyBranch; 
use Illuminate\Support\Facades\Auth; 

class CompanyBranchController extends Controller
{
    public function getAllBranch()
    {
        $companyBranch = CompanyBranch::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $companyBranch], 200);
    }

    public function save()
    {
        $companyBranch = request()->uuid ? CompanyBranch::find(request()->uuid) : new CompanyBranch();
        $auth = \Auth::user();
        $companyBranch->company_id = $auth->company_id;
        $companyBranch->branch_name = request()->branch_name;
        $companyBranch->branch_shortname = request()->branch_shortname;
        $companyBranch->save();

        $companyBranch = CompanyBranch::find($companyBranch->uuid);

        return response()->json(['success' => 1, 'rows' => $companyBranch], 200);
    }

    public function delete()
    {
        $companyBranch = CompanyBranch::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Company Branch Deleted!'], 200);
    }
}