<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\PriceRuleSupplierItem; 
use Illuminate\Support\Facades\Auth; 

class PriceRuleSupplierItemController extends Controller
{
    public function getSupplierItem()
    {
        $supplierItem = PriceRuleSupplierItem::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $supplierItem], 200);
    }

    public function save($priceRuleSupplierDetailUUID)
    {
        $priceRuleItem = PriceRuleSupplierItem::where('price_rule_supplier_detail_uuid','=',$priceRuleSupplierDetailUUID)->where('item_uuid','=',request()->item_uuid)->first();
        $priceRuleItem = ($priceRuleItem) ? $priceRuleItem : new PriceRuleSupplierItem;

        if (!$priceRuleSupplierDetailUUID || is_null($priceRuleSupplierDetailUUID)) {
            return response()->json(['success' => 0, 'message' => 'An error occur while saving..'], 500);
        }

        $auth = \Auth::user();
        $priceRuleItem->company_id = $auth->company_id;
        $priceRuleItem->price_rule_supplier_detail_uuid = $priceRuleSupplierDetailUUID;
        $priceRuleItem->item_uuid = request()->item_uuid;
        $priceRuleItem->save();

        $priceRuleItem = PriceRuleSupplierItem::find($priceRuleItem->uuid);
        return response()->json(['success' => 1, 'rows' => $priceRuleItem], 200);
    }


    public function delete($priceRuleSupplierDetailUUID, $itemUUID)
    {
        $priceRuleItem = PriceRuleSupplierItem::where('price_rule_supplier_detail_uuid','=',$priceRuleSupplierDetailUUID)->where('item_uuid','=',$itemUUID)->forceDelete();
        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}