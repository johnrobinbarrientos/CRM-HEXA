<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyCostCenter; 
use Illuminate\Support\Facades\Auth; 

class CompanyCostCenterController extends Controller
{
    public function getCostCenter()
    {
        $list = CompanyCostCenter::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('cost_center_name','LIKE','%'.$keyword.'%')
                ->orWhere('cost_center_shortname','LIKE','%'.$keyword.'%');
            });
        }

        $count = $list->count();

        // pagination
        $take = (is_numeric(request()->take) && request()->take <= 50) ? request()->take: 20;
        $page = (is_numeric(request()->page)) ? request()->page : 1;
        $offset = (($page - 1 ) * $take);

        $list = $list->take($take);
        $list = $list->offset($offset);
        $list = $list->get();

        return response()->json(['success' => 1, 'rows' => $list, 'count' => $count], 200);
    }

    public function save()
    {
        $companyCostCenter = request()->uuid ? CompanyCostCenter::find(request()->uuid) : new CompanyCostCenter();
        $auth = \Auth::user();
        $companyCostCenter->company_id = $auth->company_id;
        $companyCostCenter->cost_center_name = request()->cost_center_name;
        $companyCostCenter->cost_center_shortname = request()->cost_center_shortname;
        $companyCostCenter->is_group = request()->is_group;
        $companyCostCenter->cost_center_group = request()->cost_center_group;
        $companyCostCenter->save();

        $companyCostCenter = CompanyCostCenter::find($companyCostCenter->uuid);

        return response()->json(['success' => 1, 'rows' => $companyCostCenter], 200);
    }

    public function delete()
    {
        $companyCostCenter = CompanyCostCenter::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Company Cost Center Deleted!'], 200);
    }
}