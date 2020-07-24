<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemCategory4; 
use Illuminate\Support\Facades\Auth; 

class ItemCategory4Controller extends Controller
{
    public function getAllCategory()
    {
        $Category4 = ItemCategory4::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $Category4], 200);
    }

    public function save()
    {
        $Category4 = new ItemCategory4();
        $auth = \Auth::user();
        $Category4->company_id = $auth->company_id;
        $Category4->category4 = request()->category4;
        $Category4->save();

        $Category4 = ItemCategory4::find($Category4->uuid);
        return response()->json(['success' => 1, 'data' => $Category4, 'message' => 'Category Added!'], 200); 
    }


    public function update()
    {
        $Category4 = ItemCategory4::find(request()->uuid);

        if (!$Category4) {
            return response()->json(['success' => 0, 'message' => 'Could not find Category!'], 200);
        }

        $Category4->category4 = request()->category4;
        $Category4->save();
        
        return response()->json(['success' => 1, 'data' => $Category4, 'message' => 'Category Updated!'], 200); 
    }

    public function delete()
    {
        $Category4 = ItemCategory4::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Category Deleted!'], 200);
    }
}