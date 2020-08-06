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
        $itemAssetGroup = ItemAssetGroup::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $itemAssetGroup], 200);
    }


    public function save()
    {
        $itemAssetGroup = request()->uuid ? ItemAssetGroup::find(request()->uuid) : new ItemAssetGroup();
        $auth = \Auth::user();
        $itemAssetGroup->company_id = $auth->company_id;
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