<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\PriceRuleSupplier; 
use App\Models\PriceRuleSupplierDetail; 
use App\Models\PriceRuleSupplierItem; 
use Illuminate\Support\Facades\Auth; 

class PriceRuleSupplierController extends Controller
{
    public function getPriceRuleSuppliers()
    {
        $supplierRules = PriceRuleSupplier::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $supplierRules], 200);
    }

    public function getPriceRuleSupplierDetails($uuid)
    {
        $supplierRule = PriceRuleSupplier::find($uuid);
        return response()->json(['success' => 1, 'data' => $supplierRule], 200);
    }

    public function save()
    {
        $supplierRule = request()->uuid ? PriceRuleSupplier::find(request()->uuid) : new PriceRuleSupplier();

        $supplierRule->rule_name = request()->rule_name;
        $supplierRule->rate = request()->rate;
        $supplierRule->date_start = request()->date_start;
        $supplierRule->date_end = request()->date_end;
        $supplierRule->mechanics = request()->mechanics;
        $supplierRule->target_amount = request()->target_amount;
        $supplierRule->save();

        $supplierRule = PriceRuleSupplier::find($supplierRule->uuid);
        
        /*
        $suppliers = request()->suppliers;
        $suppliers = (is_array($suppliers)) ? $suppliers : [];

        $remove = PriceRuleSupplierDetail::where('price_rule_supplier_uuid','=',$supplierRule->uuid)->delete();
        
        foreach ($suppliers as $supplier) {
            $rule = PriceRuleSupplierDetail::where('price_rule_supplier_uuid','=',$supplierRule->uuid)
                ->where('supplier_uuid','=',$supplier['supplier_uuid'])
                ->withTrashed()
                ->first();

            $rule = ($rule) ? $rule : new PriceRuleSupplierDetail();
            $rule->company_id = $auth->company_id;
            $rule->price_rule_supplier_uuid = $supplierRule->uuid;
            $rule->supplier_uuid = $supplier['supplier_uuid'];
            $rule->applied_to = $supplier['applied_to'];
            $rule->save();

            if ($rule->applied_to == 'selected') {
                
                $remove_rule_items = PriceRuleSupplierItem::where('price_rule_supplier_detail_uuid','=',$rule->uuid)->delete();

                $items =  (is_array($supplier['items'])) ? $supplier['items'] : [];
                
                foreach ($items as $item) {
                    $rule_item = PriceRuleSupplierItem::where('price_rule_supplier_detail_uuid','=',$rule->uuid)
                    ->where('item_uuid','=',$item)
                    ->withTrashed()
                    ->first();

                    $rule_item = ($rule_item) ?  $rule_item : new PriceRuleSupplierItem();

                    $rule_item->company_id = $auth->company_id;
                    $rule_item = ($rule_item) ? $rule_item : new PriceRuleSupplierDetail();
                    $rule_item->price_rule_supplier_detail_uuid = $rule->uuid;
                    $rule_item->item_uuid = $item;
                    $rule_item->save();

                }   
            }
        }
        */

        return response()->json(['success' => 1, 'rows' => $supplierRule], 200);
    }


    public function delete()
    {
        $supplierRule = PriceRuleSupplier::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}