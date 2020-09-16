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

    public function save()
    {
        $supplierItem = request()->uuid ? PriceRuleSupplierItem::find(request()->uuid) : new PriceRuleSupplierItem();
        $auth = \Auth::user();
        $supplierItem->company_id = $auth->company_id;
        $supplierItem->price_rule_supplier_uuid = request()->price_rule_supplier_uuid;
        $supplierItem->item_uuid = request()->item_uuid;
        $supplierItem->save();

        $supplierItem = PriceRuleSupplierItem::find($supplierItem->uuid);

        return response()->json(['success' => 1, 'rows' => $supplierItem], 200);
    }


    public function delete()
    {
        $supplierItem = PriceRuleSupplierItem::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}