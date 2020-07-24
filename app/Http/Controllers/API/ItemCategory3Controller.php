<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemCategory3; 
use Illuminate\Support\Facades\Auth; 

class ItemCategory3Controller extends Controller
{
    public function getAllCategory()
    {
        $Category3 = ItemCategory3::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $Category3], 200);
    }

    public function save()
    {
        $Category3 = new ItemCategory3();
        $auth = \Auth::user();
        $Category3->company_id = $auth->company_id;
        $Category3->category3 = request()->category3;
        $Category3->save();

        $Category3 = ItemCategory3::find($Category3->uuid);
        return response()->json(['success' => 1, 'data' => $Category3, 'message' => 'Category Added!'], 200); 
    }


    public function update()
    {
        $Category3 = ItemCategory3::find(request()->uuid);

        if (!$Category3) {
            return response()->json(['success' => 0, 'message' => 'Could not find Category!'], 200);
        }

        $Category3->category3 = request()->category3;
        $Category3->save();
        
        return response()->json(['success' => 1, 'data' => $Category3, 'message' => 'Category Updated!'], 200); 
    }

    public function delete()
    {
        $Category3 = ItemCategory3::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Category Deleted!'], 200);
    }
}