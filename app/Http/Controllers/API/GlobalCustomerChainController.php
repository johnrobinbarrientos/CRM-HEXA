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
        $chain = GlobalCustomerChain::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $chain], 200);
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