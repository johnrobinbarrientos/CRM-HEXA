<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemCatForm; 
use Illuminate\Support\Facades\Auth; 

class ItemCatFormController extends Controller
{
    public function index()
    {
        $list = ItemCatForm::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('form','LIKE','%'.$keyword.'%');
            });
        }

        $count = $list->count();

        // pagination
        $take = (is_numeric(request()->take) && request()->take <= 100) ? request()->take: 20;
        $page = (is_numeric(request()->page)) ? request()->page : 1;
        $offset = (($page - 1 ) * $take);

        $list = $list->take($take);
        $list = $list->offset($offset);
        $list = $list->get();

        return response()->json(['success' => 1, 'rows' => $list, 'count' => $count, 'offset' => $offset, 'results' => count($list)], 200);
    }

    public function save()
    {
        $cat = request()->uuid ? ItemCatForm::find(request()->uuid) : new ItemCatForm();

        $cat->form = request()->form;
        $cat->save();

        $cat = ItemCatForm::find($cat->uuid);

        return response()->json(['success' => 1, 'rows' => $cat], 200);
    }


    public function delete()
    {
        $cat = ItemCatForm::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}