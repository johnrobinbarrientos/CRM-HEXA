<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemAssetGroup; 
use Illuminate\Support\Facades\Auth; 

class ItemAssetGroupController extends Controller
{
    public function getItemAssetGroup()
    {
        $list = ItemAssetGroup::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('asset_group','LIKE','%'.$keyword.'%');
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
        $itemAssetGroup = request()->uuid ? ItemAssetGroup::find(request()->uuid) : new ItemAssetGroup();

        $itemAssetGroup->asset_group = request()->asset_group;
        $itemAssetGroup->save();

        $itemAssetGroup = ItemAssetGroup::find($itemAssetGroup->uuid);

        return response()->json(['success' => 1, 'rows' => $itemAssetGroup], 200);
    }

    public function delete()
    {
        $itemAssetGroup = ItemAssetGroup::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Item Asset Deleted!'], 200);
    }
}