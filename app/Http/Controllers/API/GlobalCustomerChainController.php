<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\GlobalCustomerChain; 
use Illuminate\Support\Facades\Auth; 

class GlobalCustomerChainController extends Controller
{
    public function getCustomerChains()
    {
        $list = GlobalCustomerChain::whereNull('deleted_at');

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

        return response()->json(['success' => 1, 'rows' => $list, 'count' => $count], 200);
    }

    public function save()
    {
        $chain = request()->uuid ? GlobalCustomerChain::find(request()->uuid) : new GlobalCustomerChain();
        $chain->chain = request()->chain;
        $chain->save();

        $chain = GlobalCustomerChain::find($chain->uuid);

        return response()->json(['success' => 1, 'rows' => $chain], 200);
    }


    public function delete()
    {
        $chain = GlobalCustomerChain::find(request()->uuid)->delete();
        return response()->json(['success' => 1, 'rows' => $chain], 200);
    }
}