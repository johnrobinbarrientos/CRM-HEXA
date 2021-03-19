<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CostCenter; 
use Illuminate\Support\Facades\Auth; 

class CostCenterController extends Controller
{
    public function index()
    {
        $list = CostCenter::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('cost_center_name','LIKE','%'.$keyword.'%')
                ->orWhere('cost_center_shortname','LIKE','%'.$keyword.'%');
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

        return response()->json(['success' => 1, 'rows' => $list, 'count' => $count, 'offset' => $offset, 'results' => count($list)], 200);
    }

    public function save()
    {
        $costCenter = request()->uuid ? CostCenter::find(request()->uuid) : new CostCenter();
        $costCenter->cost_center_name = request()->cost_center_name;
        $costCenter->cost_center_shortname = request()->cost_center_shortname;
        $costCenter->is_group = request()->is_group;
        $costCenter->cost_center_group = request()->cost_center_group;
        $costCenter->save();

        $costCenter = CostCenter::find($costCenter->uuid);

        return response()->json(['success' => 1, 'rows' => $costCenter], 200);
    }

    public function delete()
    {
        $costCenter = CostCenter::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Cost Center Deleted!'], 200);
    }
}