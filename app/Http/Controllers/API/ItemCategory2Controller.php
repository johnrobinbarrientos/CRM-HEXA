<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemCategory2; 
use Illuminate\Support\Facades\Auth; 

class ItemCategory2Controller extends Controller
{
    public function getCategories()
    {
        $cat2 = ItemCategory2::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $cat2], 200);
    }

    public function save()
    {
        $cat2 = request()->uuid ? ItemCategory2::find(request()->uuid) : new ItemCategory2();
        $auth = \Auth::user();
        $cat2->company_id = $auth->company_id;
        $cat2->category2 = request()->category2;
        $cat2->save();

        $cat2 = ItemCategory2::find($cat2->uuid);

        return response()->json(['success' => 1, 'rows' => $cat2], 200);
    }


    public function delete()
    {
        $Category2 = ItemCategory2::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Category Deleted!'], 200);
    }
}