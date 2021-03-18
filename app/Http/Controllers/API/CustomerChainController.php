<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CustomerChain; 
use Illuminate\Support\Facades\Auth; 

class CustomerChainController extends Controller
{
    public function index()
    {
        $list = CustomerChain::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('chain','LIKE','%'.$keyword.'%');
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
        $chain = request()->uuid ? CustomerChain::find(request()->uuid) : new CustomerChain();
        $chain->chain = request()->chain;
        $chain->save();

        $chain = CustomerChain::find($chain->uuid);

        return response()->json(['success' => 1, 'rows' => $chain], 200);
    }


    public function delete()
    {
        $chain = CustomerChain::find(request()->uuid)->delete();
        return response()->json(['success' => 1, 'rows' => $chain], 200);
    }

    public function getCustomerChain()
    {
        $chain = CustomerChain::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $chain], 200);
    }
}