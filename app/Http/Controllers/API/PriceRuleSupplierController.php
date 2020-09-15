<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\PriceRuleSupplier; 
use Illuminate\Support\Facades\Auth; 

class PriceRuleSupplierController extends Controller
{
    public function getPriceRuleSupplier()
    {
        $supplierRule = PriceRuleSupplier::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $supplierRule], 200);
    }

    public function save()
    {
        $supplierRule = request()->uuid ? PriceRuleSupplier::find(request()->uuid) : new PriceRuleSupplier();
        $auth = \Auth::user();
        $supplierRule->company_id = $auth->company_id;
        $supplierRule->rule_name = request()->rule_name;
        $supplierRule->type = request()->type;
        $supplierRule->rate = request()->rate;
        $supplierRule->fixed = request()->fixed;
        $supplierRule->date_start = request()->date_start;
        $supplierRule->date_end = request()->date_end;
        $supplierRule->mechanics = request()->mechanics;
        $supplierRule->minimum_amount = request()->minimum_amount;
        $supplierRule->maximum_amount = request()->maximum_amount;
        $supplierRule->save();

        $supplierRule = PriceRuleSupplier::find($supplierRule->uuid);

        return response()->json(['success' => 1, 'rows' => $supplierRule], 200);
    }


    public function delete()
    {
        $supplierRule = PriceRuleSupplier::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}