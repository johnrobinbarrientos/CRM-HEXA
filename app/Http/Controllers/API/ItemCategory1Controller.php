<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemCategory1; 
use Illuminate\Support\Facades\Auth; 

class ItemCategory1Controller extends Controller
{
    public function getCategories()
    {
        $cat1 = ItemCategory1::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $cat1], 200);
    }

    public function save()
    {
        $cat1 = request()->uuid ? ItemCategory1::find(request()->uuid) : new ItemCategory1();
        $auth = \Auth::user();
        $cat1->company_id = $auth->company_id;
        $cat1->category1 = request()->category1;
        $cat1->save();

        $cat1 = ItemCategory1::find($cat1->uuid);

        return response()->json(['success' => 1, 'rows' => $cat1], 200);
    }


    public function delete()
    {
        $cat1 = ItemCategory1::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Category Deleted!'], 200);
    }
}