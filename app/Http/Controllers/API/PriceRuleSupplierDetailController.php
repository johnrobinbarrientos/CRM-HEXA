<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\PriceRuleSupplierDetail; 
use App\Models\PriceRuleSupplierItem; 
use Illuminate\Support\Facades\Auth; 

class PriceRuleSupplierDetailController extends Controller
{
    public function index($priceRuleSupplierUUID)
    {
        $priceRuleSupplierDetails = PriceRuleSupplierDetail::where('price_rule_supplier_uuid','=',$priceRuleSupplierUUID)->get();
        
        foreach ($priceRuleSupplierDetails as $priceRuleSupplierDetail) {
            $priceRuleSupplierItems = PriceRuleSupplierItem::where('price_rule_supplier_detail_uuid','=',$priceRuleSupplierDetail->uuid)->pluck('item_uuid')->toArray();
            $priceRuleSupplierDetail->items = $priceRuleSupplierItems;
        }

        return response()->json(['success' => 1, 'rows' => $priceRuleSupplierDetails], 200);
    }

    public function save($priceRuleSupplierUUID)
    {
        $auth = \Auth::user();
        $priceRuleSupplierDetail = PriceRuleSupplierDetail::where('price_rule_supplier_uuid','=',$priceRuleSupplierUUID)->where('supplier_uuid','=',request()->supplier_uuid)->first();
        $priceRuleSupplierDetail = ($priceRuleSupplierDetail) ? $priceRuleSupplierDetail : new PriceRuleSupplierDetail;

        $priceRuleSupplierDetail->company_id = $auth->company_id;
        $priceRuleSupplierDetail->price_rule_supplier_uuid = $priceRuleSupplierUUID;
        $priceRuleSupplierDetail->supplier_uuid = request()->supplier_uuid;
        $priceRuleSupplierDetail->applied_to = request()->applied_to;
        $priceRuleSupplierDetail->save();

        $priceRuleSupplierDetail = PriceRuleSupplierDetail::find($priceRuleSupplierDetail->uuid);

        return response()->json(['success' => 1, 'data' => $priceRuleSupplierDetail], 200);
    }


    public function delete($priceRuleSupplierUUID, $priceRuleSupplierDetailUUID)
    {
        $priceRuleSupplierDetail = PriceRuleSupplierDetail::find($priceRuleSupplierDetailUUID);

        if ($priceRuleSupplierDetail) {
            $priceRuleSupplierItems = PriceRuleSupplierItem::where('price_rule_supplier_detail_uuid','=',$priceRuleSupplierDetail->uuid)->forceDelete();
            $priceRuleSupplierDetail->forceDelete();
        }

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}