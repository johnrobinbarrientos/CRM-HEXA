<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemCategory3; 
use Illuminate\Support\Facades\Auth; 

class ItemCategory3Controller extends Controller
{
    public function getCategories()
    {
        $list = ItemCategory3::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('category3','LIKE','%'.$keyword.'%');
            });
        }

        $count = $list->count();

        // pagination
        $take = (is_numeric(request()->take) && request()->take <= 50) ? request()->take: 20;
        $page = (is_numeric(request()->page)) ? request()->page : 1;
        $offset = (($page - 1 ) * $take);

        $list = $list->take($take);
        $list = $list->offset($offset);
        $list = $list->get();

        return response()->json(['success' => 1, 'rows' => $list, 'count' => $count], 200);
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