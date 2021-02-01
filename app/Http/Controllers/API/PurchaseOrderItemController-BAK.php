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
use App\Models\SupplierBaseDiscountGroupItem; 
use App\Models\ItemUom; 

use App\Models\SupplierList;  
use App\Models\SupplierRegularDiscount;   
use App\Models\SupplierBaseDiscountGroup;
use App\Models\SupplierBaseDiscountGroupDetail;

use App\Models\PriceRuleSupplier;  
use App\Models\PriceRuleSupplierDetail;  
use App\Models\PriceRuleSupplierItem;  

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\PurchaseOrderSupplierBaseDiscountGroup;

use App\Models\PurchaseOrderAdditionalDiscount; 
use App\Models\PurchaseOrderBaseDiscountGroup; 
use App\Models\PurchaseOrderBaseDiscountGroupDetail; 
use App\Models\PurchaseOrderBaseDiscountGroupItem; 

use App\Models\PurchasePriceRule;  
use App\Models\PurchasePriceRuleDetail;  
use App\Models\PurchasePriceRuleItem; 

use Illuminate\Support\Facades\Auth; 

class PurchaseOrderItemController extends Controller
{
    public function index($orderUUID)
    {
        $order = PurchaseOrder::find($orderUUID);
        
        $buy_and_pay_order_base_discount_group_count = PurchaseOrderBaseDiscountGroup::where('bp_order_uuid','=',$orderUUID)->count();

        if ($buy_and_pay_order_base_discount_group_count > 0) {
            // only get items on selected supplier discount groups table
            $buy_and_pay_order_base_discount_group_item_uuids = PurchaseOrderBaseDiscountGroupItem::where('bp_order_uuid',$order->uuid)->pluck('item_uuid')->toArray();
            $items = ItemList::whereIn('uuid',$buy_and_pay_order_base_discount_group_item_uuids)->get();
        } else {
            $item_ids = ItemSupplier::where('supplier_uuid','=',$order->supplier_uuid)->pluck('item_uuid')->toArray();
            $items = ItemList::whereIn('uuid',$item_ids)->get();
        }

        $po_date = date('Y-m-d',strtotime($order->date_purchased));
        $supplier_base_discount_groups = SupplierBaseDiscountGroup::where('supplier_id',$order->supplier_uuid)->get();
        $supplier_price_rules = PriceRuleSupplier::where('date_start','<=',$po_date)
            ->where('date_end','>=',$po_date)
            ->get();

        foreach ($items as $item) {

            // get all item base discounts
            $buy_and_pay_order_base_discount_group_item_uuids = PurchaseOrderBaseDiscountGroupItem::where('bp_order_uuid','=',$orderUUID)
                ->where('item_uuid','=',$item->uuid)
                ->pluck('bp_order_base_discount_group_detail_uuid')
                ->toArray();

            $item->base_discount_group = SupplierBaseDiscountGroupItem::where('item_uuid',$item->uuid)->where('supplier_uuid','=',$order->supplier_uuid)->with('SupplierBaseDiscountGroup')->first();
            
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
            
            $order_detail = PurchaseOrderItem::where('bp_order_uuid','=',$orderUUID)->where('item_uuid','=',$item->uuid)->first();
            
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

        $selected_items = $order_detail = PurchaseOrderItem::where('bp_order_uuid','=',$orderUUID)->get();

        return response()->json(['success' => 1, 'rows' => $items, 'selected_items' => $selected_items], 200);
    }

    public function save($orderUUID)
    {
        $auth = \Auth::user();
        $items = (is_array(request()->items)) ? request()->items : [];
     
    
        $order = PurchaseOrder::find($orderUUID);

        $this->saveAdditionalDiscount($order);

        $barcodes = [];
        foreach ($items as $item) {
            $item = (object) $item;
            $barcodes[] = $item->barcode;
        }
    
        $delete = PurchaseOrderItem::where('bp_order_uuid','=',$orderUUID)->whereNotIn('barcode',$barcodes)->delete();

        foreach ($items as $item) {
            $item = (object) $item;

            $order_detail = PurchaseOrderItem::where('bp_order_uuid','=',$orderUUID)->where('item_uuid','=',$item->uuid)->where('barcode','=',$item->barcode)->withTrashed()->first();
            $order_detail = ($order_detail) ? $order_detail : new PurchaseOrderItem;

            $order_detail->bp_order_uuid            = $order->uuid;
            $order_detail->item_uuid                = $item->uuid;
            $order_detail->barcode                  = $item->barcode;
            $order_detail->order_qty                = $item->quantity;
            $order_detail->accepted_qty             = 0;
            $order_detail->purchase_price           = $item->purchase_price;
            $order_detail->gross_amount             = $item->gross_amount;
            $order_detail->discount_rate            = $item->discount_rate;
            $order_detail->discount_amount          = $item->discount_amount;
            $order_detail->net_amount               = $item->net_amount;
            $order_detail->vat_amount               = $item->vat_amount;
            $order_detail->total_amount             = $item->total_amount;
            $order_detail->deleted_at               = null;
            $order_detail->save();
        }

        return response()->json(['success' => 1, 'message' => 'success'], 200);
    }

    public function saveAdditionalDiscount($order)
    {
        $auth = \Auth::user();

        $defaults = [];
        $defaults[] = [ 'discount_name' => 'Price Off Discount','discount_type' =>  'rate','discount_rate' => 0.00,'discount_fixed' => 0.00];
        $defaults[] = [ 'discount_name' => 'Volume Discount','discount_type' =>  'rate','discount_rate' => 0.00,'discount_fixed' => 0.00];
        $defaults[] = [ 'discount_name' => 'Move-out Discount','discount_type' => 'rate','discount_rate' => 0.00,'discount_fixed' => 0.00];
        $defaults[] = [ 'discount_name' => 'Seasonal Discount','discount_type' =>  'rate','discount_rate' => 0.00,'discount_fixed' => 0.00];
        $defaults[] = [ 'discount_name' => 'Other Peso Discount','discount_type' => 'fixed','discount_rate' => 0.00,'discount_fixed' => 0.00];

        $discounts = (isset(request()->discounts) && is_array(request()->discounts)) ? request()->discounts : $defaults;
        
        $orderUUID = $order->uuid;

        $order = PurchaseOrder::find($orderUUID);
        $delete = PurchaseOrderAdditionalDiscount::where('bp_order_uuid','=',$orderUUID)->delete();

        foreach ($discounts as $discount) {
            $discount = (object) $discount;
           
            $uuid = (isset($discount->uuid)) ? $discount->uuid : '';
     
            $additional_discount = PurchaseOrderAdditionalDiscount::where('bp_order_uuid','=',$orderUUID)->where('uuid','=',$uuid)->withTrashed()->first();
  
            $additional_discount = ($additional_discount) ? $additional_discount : new  PurchaseOrderAdditionalDiscount;

            $additional_discount->bp_order_uuid            = $order->uuid;
            $additional_discount->discount_name            = $discount->discount_name;
            $additional_discount->discount_type            = $discount->discount_type;
            $additional_discount->discount_rate            = $discount->discount_rate;
            $additional_discount->discount_fixed           = $discount->discount_fixed;
            $additional_discount->deleted_at               = null;
            $additional_discount->save();
        }

        $additional_discounts = PurchaseOrderAdditionalDiscount::where('bp_order_uuid','=',$orderUUID)->get();

        return response()->json(['success' => 1, 'rows' => $additional_discounts], 200);
    }


    public function getBaseDiscounts($order)
    {
        $auth = \Auth::user();
        
        $supplier_base_discount_group_uuids = request()->selected_supplier_discount_groups;
        $supplier_base_discount_groups = SupplierBaseDiscountGroup::whereIn('uuid',$supplier_base_discount_group_uuids)->get();

        foreach ($supplier_base_discount_groups as $supplier_base_discount_group) {
            
            $buy_and_pay_order_base_discount_group = PurchaseOrderBaseDiscountGroup::where('bp_order_uuid','=',$order->uuid)
                ->where('supplier_base_discount_group_uuid','=',$supplier_base_discount_group->uuid)
                ->withTrashed()
                ->first();

            $buy_and_pay_order_base_discount_group = ($buy_and_pay_order_base_discount_group) ? $buy_and_pay_order_base_discount_group : new PurchaseOrderBaseDiscountGroup;
            $buy_and_pay_order_base_discount_group->bp_order_uuid = $order->uuid;
            $buy_and_pay_order_base_discount_group->supplier_uuid = $supplier_base_discount_group->supplier_uuid;
            $buy_and_pay_order_base_discount_group->supplier_base_discount_group_uuid = $supplier_base_discount_group->uuid;
            $buy_and_pay_order_base_discount_group->group_name = $supplier_base_discount_group->group_name;
            $buy_and_pay_order_base_discount_group->deleted_at = null;
            $buy_and_pay_order_base_discount_group->save();

            $supplier_base_discount_group_details = SupplierBaseDiscountGroupDetail::where('supplier_base_discount_group_uuid','=',$supplier_base_discount_group->uuid)->get();
            
            foreach ($supplier_base_discount_group_details as $supplier_base_discount_group_detail) {

                $buy_and_pay_order_base_discount_group_detail = PurchaseOrderBaseDiscountGroupDetail::where('bp_order_uuid','=', $order->uuid)
                    ->where('bp_order_base_discount_group_uuid','=', $buy_and_pay_order_base_discount_group->uuid)
                    ->where('supplier_base_discount_group_detail_uuid','=', $supplier_base_discount_group_detail->uuid)
                    ->withTrashed()
                    ->first();

                $buy_and_pay_order_base_discount_group_detail = ($buy_and_pay_order_base_discount_group_detail) ? $buy_and_pay_order_base_discount_group_detail : new PurchaseOrderBaseDiscountGroupDetail;

                $buy_and_pay_order_base_discount_group_detail->supplier_base_discount_group_detail_uuid = $supplier_base_discount_group_detail->uuid;
                $buy_and_pay_order_base_discount_group_detail->bp_order_base_discount_group_uuid = $buy_and_pay_order_base_discount_group->uuid;
                $buy_and_pay_order_base_discount_group_detail->bp_order_uuid = $order->uuid;
                $buy_and_pay_order_base_discount_group_detail->discount_name = $supplier_base_discount_group_detail->discount_name;
                $buy_and_pay_order_base_discount_group_detail->discount_rate = $supplier_base_discount_group_detail->discount_rate;
                $buy_and_pay_order_base_discount_group_detail->deleted_at = null;
                $buy_and_pay_order_base_discount_group_detail->save();
                
                // SupplierBaseDiscountGroupItem to be changed to SupplierBaseDiscountGroupItem 
                $supplier_base_discount_group_items = SupplierBaseDiscountGroupItem::where('supplier_base_discount_group_uuid','=',$supplier_base_discount_group_detail->supplier_base_discount_group_uuid)->get();

                foreach ($supplier_base_discount_group_items as $supplier_base_discount_group_item) {

                    $buy_and_pay_order_base_discount_group_item = PurchaseOrderBaseDiscountGroupItem::where('bp_order_uuid','=', $order->uuid)
                        ->where('bp_order_base_discount_group_detail_uuid','=',$buy_and_pay_order_base_discount_group_detail->uuid)
                        ->withTrashed()
                        ->first();

                    $buy_and_pay_order_base_discount_group_item = new PurchaseOrderBaseDiscountGroupItem;

                    $buy_and_pay_order_base_discount_group_item->bp_order_uuid = $order->uuid;
                    $buy_and_pay_order_base_discount_group_item->item_uuid = $supplier_base_discount_group_item->item_uuid;
                    $buy_and_pay_order_base_discount_group_item->supplier_uuid = $supplier_base_discount_group_item->supplier_uuid;
                    $buy_and_pay_order_base_discount_group_item->bp_order_base_discount_group_detail_uuid = $buy_and_pay_order_base_discount_group_detail->uuid;
                    $buy_and_pay_order_base_discount_group_item->deleted_at = null;
                    $buy_and_pay_order_base_discount_group_item->save();
                }
            }
        }
    }

    public function deleteOrderDetail()
    {
        $orders = PurchaseOrderItem::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}