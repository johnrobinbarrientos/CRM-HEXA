<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemCategory2; 
use Illuminate\Support\Facades\Auth; 

class ItemCategory2Controller extends Controller
{
    public function getAllCategory()
    {
        $Category2 = ItemCategory2::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $Category2], 200);
    }

    public function save()
    {
        $Category2 = new ItemCategory2();
        $auth = \Auth::user();
        $Category2->company_id = $auth->company_id;
        $Category2->category2 = request()->category2;
        $Category2->save();

        $Category2 = ItemCategory2::find($Category2->uuid);
        return response()->json(['success' => 1, 'data' => $Category2, 'message' => 'Category Added!'], 200); 
    }


    public function update()
    {
        $Category2 = ItemCategory2::find(request()->uuid);

        if (!$Category2) {
            return response()->json(['success' => 0, 'message' => 'Could not find Category!'], 200);
        }

        $Category2->category2 = request()->category2;
        $Category2->save();
        
        return response()->json(['success' => 1, 'data' => $Category2, 'message' => 'Category Updated!'], 200); 
    }

    public function delete()
    {
        $Category2 = ItemCategory2::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Category Deleted!'], 200);
    }
}