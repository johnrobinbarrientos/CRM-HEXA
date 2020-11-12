<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;

use App\Models\CompanyList;
use App\Models\CompanyBranch;
use App\Models\CompanyBranchLocation;

use App\Models\ItemList;
use App\Models\ItemGroup;
use App\Models\ItemAssetGroup;
use App\Models\ItemSupplier; 
use App\Models\ItemSupplierDiscount; 
use App\Models\ItemUom;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\PurchaseOrderSupplierBaseDiscountGroup;

use App\Models\PurchaseOrderAdditionalDiscount; 
use App\Models\PurchaseOrderBaseDiscountGroup; 
use App\Models\PurchaseOrderBaseDiscountGroupDetail; 
use App\Models\PurchaseOrderBaseDiscountGroupItem; 

use App\Models\PurchasePriceRule;  
use App\Models\PurchasePriceRuleDetail;  
use App\Models\PurchasePriceRuleItem; 

use App\Models\SupplierList;  
use App\Models\SupplierRegularDiscount;   
use App\Models\SupplierBaseDiscountGroup;
use App\Models\SupplierBaseDiscountGroupDetail;


use Illuminate\Support\Facades\Auth; 

class PurchaseReceiveDetailController extends Controller
{

    public function getOrderDetails($orderUUID)
    {

        $order = PurchaseOrder::find($orderUUID);
        $supplier = SupplierList::find($order->supplier_uuid);
        $order->supplier = $supplier;

        $branch = CompanyBranch::find($order->branch_uuid);
        $order->branch = $branch;

        $item_group = ItemGroup::find($order->item_group_uuid);
        $order->item_group = $item_group;

        $asset_group = ItemAssetGroup::find($order->asset_group_uuid);
        $order->asset_group = $asset_group;

        $branch_location = CompanyBranchLocation::find($order->branch_locations_uuid);
        $order->branch_location = $branch_location;

        $discount_groups = PurchaseOrderBaseDiscountGroup::where('bp_order_uuid','=',$orderUUID)->get();
        $order->discount_groups = $discount_groups;

        $additional_discounts = PurchaseOrderAdditionalDiscount::where('bp_order_uuid','=',$orderUUID)->get();
        $order->additional_discounts = $additional_discounts;

        return response()->json(['success' => 1, 'data' => $order], 200);
    }
    
    public function getOrderSupplierItems($orderUUID)
    {
        // $order = PurchaseOrder::find($orderUUID);
        
        $item_ids = PurchaseOrderDetail::where('bp_order_uuid','=',$orderUUID)->whereNull('deleted_at')
        ->groupBy('item_uuid')
        ->pluck('item_uuid')
        ->toArray();

        $items = ItemList::whereIn('uuid',$item_ids)->get();
        

        foreach ($items as $item) {

            // get all item base discounts
            $buy_and_pay_order_base_discount_group_item_uuids = PurchaseOrderBaseDiscountGroupItem::where('bp_order_uuid','=',$orderUUID)
                ->where('item_uuid','=',$item->uuid)
                ->pluck('bp_order_base_discount_group_detail_uuid')
                ->toArray();

            $item->base_discounts = PurchaseOrderBaseDiscountGroupDetail::whereIn('uuid',$buy_and_pay_order_base_discount_group_item_uuids)->with('OrderBaseDiscountGroup')->get();
            
            $buy_and_pay_price_rule_item_uuids = PurchasePriceRuleItem::where('bp_order_uuid','=',$orderUUID)
                ->where('item_uuid','=',$item->uuid)
                ->pluck('bp_price_rule_detail_uuid')
                ->toArray();
            
            $item->price_rule_discounts = PurchasePriceRuleDetail::whereIn('uuid',$buy_and_pay_price_rule_item_uuids)->orWhere('applied_to','=','all')->with('PriceRule')->get();
            

            $uoms = ItemUom::leftJoin('global_uom','global_uom_uuid','=','global_uom.uuid')
                ->where('item_uuid','=',$item->uuid)
                ->orderBy('packing_qtty')
                ->select('global_uom.uuid as uuid','global_uom.uom as uom','packing_qtty','barcode')
                ->get();
                
            $item->uoms = $uoms;
            $item->quantity = 0;
            $item->selected = false;
            // $item->purchase_price   = 0.00;
            $item->gross_amount     = 0.00;
            //$item->discount_rate    = 0.00;
            $item->discount_amount  = 0.00;
            $item->net_amount       = 0.00;
            $item->vat_amount       = 0.00;
            $item->total_amount     = 0.00;
            $item->item_rate        = 0.00;
            
            $order_detail = PurchaseOrderDetail::where('bp_order_uuid','=',$orderUUID)->where('item_uuid','=',$item->uuid)->first();
            
            if ($order_detail) {
                $item->quantity         = $order_detail->order_qty;
                $item->purchase_price   = $order_detail->purchase_price;
                $item->gross_amount     = $order_detail->gross_amount;
                //$item->discount_rate    = $order_detail->discount_rate;
                $item->discount_amount  = $order_detail->discount_amount;
                $item->net_amount       = $order_detail->net_amount;
                $item->vat_amount       = $order_detail->vat_amount;
                $item->total_amount     = $order_detail->total_amount;
                $item->item_rate        = $order_detail->total_amount;
            }
        }

        $selected_items = $order_detail = PurchaseOrderDetail::where('bp_order_uuid','=',$orderUUID)->get();

        return response()->json(['success' => 1, 'rows' => $items, 'selected_items' => $selected_items], 200);
    }

    
}