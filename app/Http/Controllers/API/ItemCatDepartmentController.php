<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemCatDepartment; 
use Illuminate\Support\Facades\Auth; 

class ItemCatDepartmentController extends Controller
{
    public function index()
    {
        $list = ItemCatDepartment::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('department','LIKE','%'.$keyword.'%');
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
        $cat = request()->uuid ? ItemCatDepartment::find(request()->uuid) : new ItemCatDepartment();

        $cat->department = request()->department;
        $cat->save();

        $cat = ItemCatDepartment::find($cat->uuid);

        return response()->json(['success' => 1, 'rows' => $cat], 200);
    }


    public function delete()
    {
        $cat = ItemCatDepartment::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}