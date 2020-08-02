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
        $cat5 = ItemCategory5::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $cat5], 200);
    }

    public function save()
    {
        $cat5 = request()->uuid ? ItemCategory5::find(request()->uuid) : new ItemCategory5();
        $auth = \Auth::user();
        $cat5->company_id = $auth->company_id;
        $cat5->category5 = request()->category5;
        $cat5->save();

        $cat5 = ItemCategory5::find($cat5->uuid);

        return response()->json(['success' => 1, 'rows' => $cat5], 200);
    }

    public function delete()
    {
        $cat5 = ItemCategory5::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Category Deleted!'], 200);
    }
}