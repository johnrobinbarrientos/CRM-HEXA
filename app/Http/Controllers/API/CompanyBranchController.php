<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyBranch; 
use Illuminate\Support\Facades\Auth; 

class CompanyBranchController extends Controller
{
    public function getBranch()
    {
        $list = CompanyBranch::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('branch_name','LIKE','%'.$keyword.'%')
                ->orWhere('branch_shortname','LIKE','%'.$keyword.'%');
            });
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
        $companyBranch = request()->uuid ? CompanyBranch::find(request()->uuid) : new CompanyBranch();

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