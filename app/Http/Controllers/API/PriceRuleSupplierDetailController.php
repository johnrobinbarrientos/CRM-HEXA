<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\PriceRuleSupplierDetail; 
use Illuminate\Support\Facades\Auth; 

class PriceRuleSupplierDetailController extends Controller
{
    public function getSupplierDetail()
    {
        $detailRule = PriceRuleSupplierDetail::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $detailRule], 200);
    }

    public function save()
    {
        $detailRule = request()->uuid ? PriceRuleSupplierDetail::find(request()->uuid) : new PriceRuleSupplierDetail();
        $auth = \Auth::user();
        $detailRule->company_id = $auth->company_id;
        $detailRule->price_rule_supplier_uuid = request()->price_rule_supplier_uuid;
        $detailRule->supplier_uuid = request()->supplier_uuid;
        $detailRule->applied_to = request()->applied_to;
        $detailRule->save();

        $detailRule = PriceRuleSupplierDetail::find($detailRule->uuid);

        return response()->json(['success' => 1, 'rows' => $detailRule], 200);
    }


    public function delete()
    {
        $detailRule = PriceRuleSupplierDetail::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}