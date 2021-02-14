<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemGroup; 
use Illuminate\Support\Facades\Auth; 

class ItemGroupController extends Controller
{
    public function index()
    {
        $list = ItemGroup::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('item_group','LIKE','%'.$keyword.'%');
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
        $itemGroup = request()->uuid ? ItemGroup::find(request()->uuid) : new ItemGroup();

        $itemGroup->item_group = request()->item_group;
        $itemGroup->save();

        $itemGroup = ItemGroup::find($itemGroup->uuid);

        return response()->json(['success' => 1, 'rows' => $itemGroup], 200);
    }

    public function delete()
    {
        $itemGroup = ItemGroup::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'item Group Deleted!'], 200);
    }
}