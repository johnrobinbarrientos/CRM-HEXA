<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\GlobalCustomerType; 
use Illuminate\Support\Facades\Auth; 

class GlobalCustomerTypeController extends Controller
{
    public function index()
    {
        $list = GlobalCustomerType::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('customer_type','LIKE','%'.$keyword.'%');
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
        $types = request()->uuid ? GlobalCustomerType::find(request()->uuid) : new GlobalCustomerType();
        $types->customer_type = request()->customer_type;
        $types->save();

        $types = GlobalCustomerType::find($types->uuid);

        return response()->json(['success' => 1, 'rows' => $types], 200);
    }


    public function delete()
    {
        $types = GlobalCustomerType::find(request()->uuid)->delete();
        return response()->json(['success' => 1, 'rows' => $types], 200);
    }
}