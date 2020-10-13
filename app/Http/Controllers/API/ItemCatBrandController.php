<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemCatBrand; 
use Illuminate\Support\Facades\Auth; 

class ItemCatBrandController extends Controller
{
    public function getCatBrand()
    {
        $list = ItemCatBrand::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('brand','LIKE','%'.$keyword.'%');
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
        $cat = request()->uuid ? ItemCatBrand::find(request()->uuid) : new ItemCatBrand();
        $auth = \Auth::user();
        $cat->company_id = $auth->company_id;
        $cat->brand = request()->brand;
        $cat->save();

        $cat = ItemCatBrand::find($cat->uuid);

        return response()->json(['success' => 1, 'rows' => $cat], 200);
    }


    public function delete()
    {
        $cat = ItemCatBrand::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}