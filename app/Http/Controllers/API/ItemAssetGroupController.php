<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemAssetGroup; 
use Illuminate\Support\Facades\Auth; 

class ItemAssetGroupController extends Controller
{
    public function getAllItemAssetGroup()
    {
        $itemAssetGroup = ItemAssetGroup::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $itemAssetGroup], 200);
    }

    public function save()
    {
        $itemAssetGroup = new ItemAssetGroup();
        $auth = \Auth::user();
        $itemAssetGroup->company_id = $auth->company_id;
        $itemAssetGroup->asset_group = request()->asset_group;
        $itemAssetGroup->save();

        $itemAssetGroup = ItemAssetGroup::find($itemAssetGroup->uuid);
        return response()->json(['success' => 1, 'data' => $itemAssetGroup, 'message' => 'Item Asset Added!'], 200); 
    }


    public function update()
    {
        $itemAssetGroup = ItemAssetGroup::find(request()->uuid);

        if (!$itemAssetGroup) {
            return response()->json(['success' => 0, 'message' => 'Could not find Item Asset!'], 200);
        }

        $itemAssetGroup->asset_group = request()->asset_group;
        $itemAssetGroup->save();
        
        return response()->json(['success' => 1, 'data' => $itemAssetGroup, 'message' => 'Item Asset Updated!'], 200); 
    }

    public function delete()
    {
        $itemAssetGroup = ItemAssetGroup::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Item Asset Deleted!'], 200);
    }
}