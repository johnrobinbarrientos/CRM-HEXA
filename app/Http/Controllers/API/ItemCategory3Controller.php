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
        $cat3 = ItemCategory3::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $cat3], 200);
    }

    public function save()
    {
        $cat3 = request()->uuid ? ItemCategory3::find(request()->uuid) : new ItemCategory3();
        $auth = \Auth::user();
        $cat3->company_id = $auth->company_id;
        $cat3->category3 = request()->category3;
        $cat3->save();

        $cat3 = ItemCategory3::find($cat3->uuid);

        return response()->json(['success' => 1, 'rows' => $cat3], 200);
    }

    public function delete()
    {
        $cat3 = ItemCategory3::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Category Deleted!'], 200);
    }
}