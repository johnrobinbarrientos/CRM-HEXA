<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemCatPackingType; 
use Illuminate\Support\Facades\Auth; 

class ItemCatPackingTypeController extends Controller
{
    public function getCatPackingType()
    {
        $list = ItemCatPackingType::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('packing_type','LIKE','%'.$keyword.'%');
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
        $cat = request()->uuid ? ItemCatPackingType::find(request()->uuid) : new ItemCatPackingType();
        $auth = \Auth::user();
        $cat->company_id = $auth->company_id;
        $cat->packing_type = request()->packing_type;
        $cat->save();

        $cat = ItemCatPackingType::find($cat->uuid);

        return response()->json(['success' => 1, 'rows' => $cat], 200);
    }


    public function delete()
    {
        $cat = ItemCatPackingType::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}