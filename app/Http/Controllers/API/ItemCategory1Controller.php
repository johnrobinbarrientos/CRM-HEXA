<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemCategory1; 
use Illuminate\Support\Facades\Auth; 

class ItemCategory1Controller extends Controller
{
    public function getAllCategory()
    {
        $Category1 = ItemCategory1::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $Category1], 200);
    }

    public function save()
    {
        $Category1 = new ItemCategory1();
        $auth = \Auth::user();
        $Category1->company_id = $auth->company_id;
        $Category1->category1 = request()->category1;
        $Category1->save();

        $Category1 = ItemCategory1::find($Category1->uuid);
        return response()->json(['success' => 1, 'data' => $Category1, 'message' => 'Category Added!'], 200); 
    }


    public function update()
    {
        $Category1 = ItemCategory1::find(request()->uuid);

        if (!$Category1) {
            return response()->json(['success' => 0, 'message' => 'Could not find Category1!'], 200);
        }

        $Category1->category1 = request()->category1;
        $Category1->save();
        
        return response()->json(['success' => 1, 'data' => $Category1, 'message' => 'Category1 Updated!'], 200); 
    }

    public function delete()
    {
        $Category1 = ItemCategory1::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Category Deleted!'], 200);
    }
}