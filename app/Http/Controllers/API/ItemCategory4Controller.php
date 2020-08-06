<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemCategory4; 
use Illuminate\Support\Facades\Auth; 

class ItemCategory4Controller extends Controller
{
    public function getCategories()
    {
        $cat4 = ItemCategory4::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $cat4], 200);
    }

    public function save()
    {
        $cat4 = request()->uuid ? ItemCategory4::find(request()->uuid) : new ItemCategory4();
        $auth = \Auth::user();
        $cat4->company_id = $auth->company_id;
        $cat4->category4 = request()->category4;
        $cat4->save();

        $cat4 = ItemCategory4::find($cat4->uuid);

        return response()->json(['success' => 1, 'rows' => $cat4], 200);
    }

    public function delete()
    {
        $cat4 = ItemCategory4::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Category Deleted!'], 200);
    }
}