<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemCatManufacturer; 
use Illuminate\Support\Facades\Auth; 

class ItemCatManufacturerController extends Controller
{
    public function getCatManufacturer()
    {
        $list = ItemCatManufacturer::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('manufacturer','LIKE','%'.$keyword.'%');
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
        $cat = request()->uuid ? ItemCatManufacturer::find(request()->uuid) : new ItemCatManufacturer();
        $auth = \Auth::user();
        $cat->company_id = $auth->company_id;
        $cat->manufacturer = request()->manufacturer;
        $cat->save();

        $cat = ItemCatManufacturer::find($cat->uuid);

        return response()->json(['success' => 1, 'rows' => $cat], 200);
    }


    public function delete()
    {
        $cat1 = ItemCatManufacturer::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}