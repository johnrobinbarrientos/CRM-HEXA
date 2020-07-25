<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemCategory5; 
use Illuminate\Support\Facades\Auth; 

class ItemCategory5Controller extends Controller
{
    public function getAllCategory()
    {
        $Category5 = ItemCategory5::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $Category5], 200);
    }

    public function save()
    {
        $Category5 = new ItemCategory5();
        $auth = \Auth::user();
        $Category5->company_id = $auth->company_id;
        $Category5->category5 = request()->category5;
        $Category5->save();

        $Category5 = ItemCategory5::find($Category5->uuid);
        return response()->json(['success' => 1, 'data' => $Category5, 'message' => 'Category Added!'], 200); 
    }


    public function update()
    {
        $Category5 = ItemCategory5::find(request()->uuid);

        if (!$Category5) {
            return response()->json(['success' => 0, 'message' => 'Could not find Category!'], 200);
        }

        $Category5->category5 = request()->category5;
        $Category5->save();
        
        return response()->json(['success' => 1, 'data' => $Category5, 'message' => 'Category Updated!'], 200); 
    }

    public function delete()
    {
        $Category5 = ItemCategory5::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Category Deleted!'], 200);
    }
}