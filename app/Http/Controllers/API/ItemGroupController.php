<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemGroup; 
use Illuminate\Support\Facades\Auth; 

class ItemGroupController extends Controller
{
    public function getAllItemGroup()
    {
        $itemGroup = ItemGroup::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $itemGroup], 200);
    }

    public function save()
    {
        $itemGroup = new ItemGroup();
        $auth = \Auth::user();
        $itemGroup->company_id = $auth->company_id;
        $itemGroup->item_group = request()->item_group;
        $itemGroup->save();

        $itemGroup = ItemGroup::find($itemGroup->uuid);
        return response()->json(['success' => 1, 'data' => $itemGroup, 'message' => 'item Group Added!'], 200); 
    }


    public function update()
    {
        $itemGroup = ItemGroup::find(request()->uuid);

        if (!$itemGroup) {
            return response()->json(['success' => 0, 'message' => 'Could not find item Group!'], 200);
        }

        $itemGroup->item_group = request()->item_group;
        $itemGroup->save();
        
        return response()->json(['success' => 1, 'data' => $itemGroup, 'message' => 'item Group Updated!'], 200); 
    }

    public function delete()
    {
        $itemGroup = ItemGroup::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'item Group Deleted!'], 200);
    }
}