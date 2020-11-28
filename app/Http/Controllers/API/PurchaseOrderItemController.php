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
        $auth = \Auth::user();
        $order = PurchaseOrder::find($orderUUID);
        
        $supplier_base_discount_group_uuids = PurchaseOrderBaseDiscountGroup::where('bp_order_uuid','=',$orderUUID)
            ->pluck('supplier_base_discount_group_uuid')
            ->toArray();

        if (count($supplier_base_discount_group_uuids) > 0) {
            // only get items on selected supplier discount groups table
            $item_uuids = SupplierBaseDiscountGroupItem::whereIn('supplier_base_discount_group_uuid',$supplier_base_discount_group_uuids)
                ->pluck('item_uuid')
                ->toArray();

            $items = ItemList::whereIn('uuid',$item_uuids)->orderBy('item_description')->get();
        } else {
            $item_uuids = ItemSupplier::where('supplier_uuid','=',$order->supplier_uuid)->pluck('item_uuid')->toArray();
            $items = ItemList::whereIn('uuid',$item_uuids)->orderBy('item_description')->get();
        }

        $po_date = date('Y-m-d',strtotime($order->date_purchased));

        $base_discounts = PurchaseOrderBaseDiscountGroupDetail::where('bp_order_uuid',$order->uuid)
            ->with('PurchaseOrderBaseDiscountGroup')
            ->get();


        foreach ($base_discounts as $base_discount) {
            $purchase_order_base_discount_group = PurchaseOrderBaseDiscountGroup::find($base_discount->bp_order_base_discount_group_uuid);
            $supplier_base_discount_group_uuid = $purchase_order_base_discount_group->supplier_base_discount_group_uuid;

            $base_discount->purchase_order_base_discount_group = $purchase_order_base_discount_group;
            $base_discount_group_items = SupplierBaseDiscountGroupItem::where('supplier_base_discount_group_uuid','=',$supplier_base_discount_group_uuid)->pluck('item_uuid')->toArray();
            $base_discount->items = $base_discount_group_items;
            $base_discount->discount_amount = 0.00;
        }
     

        $price_rule_supplier_uuids = PriceRuleSupplier::where('company_id','=',$auth->company_id)
            ->where('date_start','<=',$po_date)
            ->where('date_end','>=',$po_date)
            ->pluck('uuid')
            ->toArray();


        $price_rules = PriceRuleSupplierDetail::whereIn('price_rule_supplier_uuid',$price_rule_supplier_uuids)
            ->with('PriceRuleSupplier')
            ->get();

        foreach ($price_rules as $price_rule) {
            $price_rule_items = PriceRuleSupplierItem::where('price_rule_supplier_detail_uuid','=',$price_rule->uuid)->pluck('item_uuid')->toArray();
            $price_rule->items = $price_rule_items;
        }

        $additional_discounts = PurchaseOrderAdditionalDiscount::where('bp_order_uuid','=',$orderUUID)->get();

        foreach ($items as $item) {

            $uoms = ItemUom::leftJoin('global_uom','global_uom_uuid','=','global_uom.uuid')
                ->where('item_uuid','=',$item->uuid)
                ->orderBy('packing_qtty')
                ->select('global_uom.uuid as uuid','global_uom.uom as uom','packing_qtty','barcode')
                ->get();
                
            $item->uoms = $uoms;
            $item->quantity = 0;
            $item->selected = false;
            // $item->purchase_price   = 0.00;
            // $item->discount_rate    = 0.00;
            $item->gross_amount     = 0.00;
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

        $selected_items = PurchaseOrderItem::where('bp_order_uuid','=',$orderUUID)->get();

        return response()->json([
            'success' => 1, 
            'rows' => $items, 
            'selected_items' => $selected_items, 
            'additional_discounts' => $additional_discounts, 
            'base_discounts' => $base_discounts, 
            'price_rules' => $price_rules
        ], 200);
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

            $order_detail->company_id               = $auth->company_id;
            $order_detail->bp_order_uuid            = $order->uuid;
            $order_detail->item_uuid                = $item->uuid;
            $order_detail->barcode                  = $item->barcode;
            $order_detail->order_qty                = $item->quantity;
            $order_detail->accepted_qty             = 0;
            $order_detail->purchase_price           = $item->purchase_price;
            $order_detail->gross_amount             = $item->gross_amount;
            $order_detail->discount_rate            = $item->discount_rate_total;
            $order_detail->discount_amount          = $item->discount_amount;
            $order_detail->net_amount               = $item->net_amount;
            $order_detail->vat_amount               = $item->vat_amount;
            $order_detail->total_amount             = $item->total_amount;
            $order_detail->deleted_at               = null;
            $order_detail->save();
        }


        if ($order->po_revision === null){
            $order->po_revision = 0;
        }
        else{

            $increment_revision = $order->po_revision + 1;
            
            $order->po_revision = $increment_revision;

            $position = strpos($order->po_no, '-');
            $original_id = substr($order->po_no, 0, $position);

            if($increment_revision < 10){
                
                if ($position == false){
                    $order->po_no = $order->po_no . '-' . 0 .$increment_revision;
                }
                else{
                    $order->po_no = $original_id . '-' . 0 .$increment_revision;
                }       

            }
            else{
                $order->po_no = $original_id . '-' . $increment_revision;
            }
        }

        $order->memo_po = request()->memo;

        $order->save();


        $this->saveBaseDiscountsGroupItems($order,$items);
        $this->savePriceRuleDiscounts($order,$items);

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

            $additional_discount->company_id               = $auth->company_id;
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


    public function saveBaseDiscountsGroupItems($order,$items)
    {
        $auth = \Auth::user();
        

        $po_supplier_base_discount_group_uuids = PurchaseOrderBaseDiscountGroup::where('bp_order_uuid','=',$order->uuid)->pluck('supplier_base_discount_group_uuid')->toArray();
        
        $buy_and_pay_order_base_discount_group_item = PurchaseOrderBaseDiscountGroupItem::where('bp_order_uuid','=',$order->uuid)->delete();

        foreach ($items as $item) {
            $item = (object) $item;

            $discounted_item = SupplierBaseDiscountGroupItem::whereIn('supplier_base_discount_group_uuid',$po_supplier_base_discount_group_uuids)
                ->where('supplier_uuid','=',$order->supplier_uuid)
                ->where('item_uuid','=',$item->uuid)
                ->first();

   
            if ($discounted_item) {
                $po_base_discount_group = PurchaseOrderBaseDiscountGroup::where('supplier_base_discount_group_uuid','=',$discounted_item->supplier_base_discount_group_uuid)
                    ->where('bp_order_uuid','=',$order->uuid)
                    ->first();
     
                $buy_and_pay_order_base_discount_group_item = PurchaseOrderBaseDiscountGroupItem::where('bp_order_base_discount_group_uuid','=',$po_base_discount_group->uuid)
                    ->where('item_uuid','=',$discounted_item->item_uuid)
                    ->withTrashed()
                    ->first();

                $buy_and_pay_order_base_discount_group_item = ($buy_and_pay_order_base_discount_group_item) ? $buy_and_pay_order_base_discount_group_item : new PurchaseOrderBaseDiscountGroupItem;

                $buy_and_pay_order_base_discount_group_item->company_id = $auth->company_id;
                $buy_and_pay_order_base_discount_group_item->bp_order_uuid = $order->uuid;
                $buy_and_pay_order_base_discount_group_item->item_uuid = $discounted_item->item_uuid;
                $buy_and_pay_order_base_discount_group_item->supplier_uuid = $discounted_item->supplier_uuid;
                $buy_and_pay_order_base_discount_group_item->bp_order_base_discount_group_uuid = $po_base_discount_group->uuid;
                $buy_and_pay_order_base_discount_group_item->deleted_at = null;
                $buy_and_pay_order_base_discount_group_item->save();
            }
        }
    }


    public function savePriceRuleDiscounts($order,$items)
    {
        $auth = \Auth::user();
        
        $po_date = date('Y-m-d',strtotime($order->date_purchased));

        $price_rule_supplier_uuids = PriceRuleSupplier::where('company_id','=',$auth->company_id)
            ->where('date_start','<=',$po_date)
            ->where('date_end','>=',$po_date)
            ->pluck('uuid')
            ->toArray();


        $price_rule_supplier_details = PriceRuleSupplierDetail::whereIn('price_rule_supplier_uuid',$price_rule_supplier_uuids)
            ->where('supplier_uuid','=',$order->supplier_uuid)
            ->get();

        $po_price_rule = PurchasePriceRule::where('bp_order_uuid','=',$order->uuid)->delete();
        $po_price_rule_detail = PurchasePriceRuleDetail::where('bp_order_uuid','=',$order->uuid)->delete();
        $po_price_rule_item = PurchasePriceRuleItem::where('bp_order_uuid','=',$order->uuid)->delete();

        $item_uuids = [];

        foreach ($items as $item) {
            $item = (object) $item;
            array_push($item_uuids,$item->uuid);
        }


        foreach ($price_rule_supplier_details as $price_rule_supplier_detail) {

           
            if ($price_rule_supplier_detail->applied_to == 'all') {

                $price_rule_supplier = PriceRuleSupplier::where('uuid','=',$price_rule_supplier_detail->price_rule_supplier_uuid)->first();


                $po_price_rule = PurchasePriceRule::where('bp_order_uuid','=',$order->uuid)
                ->where('price_rule_supplier_uuid','=',$price_rule_supplier_detail->price_rule_supplier_uuid)
                ->withTrashed()
                ->first();

               
                $po_price_rule = ($po_price_rule) ? $po_price_rule : new PurchasePriceRule;
                $po_price_rule->company_id                 = $auth->company_id;
                $po_price_rule->price_rule_supplier_uuid   = $price_rule_supplier_detail->price_rule_supplier_uuid;
                $po_price_rule->bp_order_uuid              = $order->uuid;
                $po_price_rule->rule_name                  = $price_rule_supplier->rule_name;
                $po_price_rule->rate                       = $price_rule_supplier->rate;
                $po_price_rule->date_start                 = $price_rule_supplier->date_start;
                $po_price_rule->date_end                   = $price_rule_supplier->date_end;
                $po_price_rule->mechanics                  = $price_rule_supplier->mechanics;
                $po_price_rule->target_amount              = $price_rule_supplier->target_amount;
                $po_price_rule->deleted_at = null;
                $po_price_rule->save();


                $po_price_rule_detail = PurchasePriceRuleDetail::where('bp_order_uuid','=',$order->uuid)
                    ->where('bp_price_rule_uuid','=',$po_price_rule->uuid)
                    ->withTrashed()
                    ->first();

                $po_price_rule_detail = ($po_price_rule_detail) ? $po_price_rule_detail : new PurchasePriceRuleDetail;
                $po_price_rule_detail->company_id                  = $auth->company_id;
                $po_price_rule_detail->bp_order_uuid               = $order->uuid;
                $po_price_rule_detail->bp_price_rule_uuid          = $po_price_rule->uuid;
                $po_price_rule_detail->supplier_uuid               = $price_rule_supplier_detail->supplier_uuid;
                $po_price_rule_detail->applied_to                  = $price_rule_supplier_detail->applied_to;
                $po_price_rule_detail->deleted_at = null;
                $po_price_rule_detail->save();

            } else if ($price_rule_supplier_detail->applied_to == 'selected') {
                
                $price_rule_supplier_item_count = PriceRuleSupplierItem::where('price_rule_supplier_detail_uuid','=',$price_rule_supplier_detail->uuid)
                    ->whereIn('item_uuid',$item_uuids)
                    ->count();
                


                // check if all selected items has price rule, skip if non of the selected items has price rule
                if ($price_rule_supplier_item_count < 1) {
                    continue;
                }

                $price_rule_supplier = PriceRuleSupplier::where('uuid','=',$price_rule_supplier_detail->price_rule_supplier_uuid)->first();

                $po_price_rule = PurchasePriceRule::where('bp_order_uuid','=',$order->uuid)
                    ->where('price_rule_supplier_uuid','=',$price_rule_supplier_detail->price_rule_supplier_uuid)
                    ->withTrashed()
                    ->first();

                $po_price_rule = ($po_price_rule) ? $po_price_rule : new PurchasePriceRule;
                $po_price_rule->company_id                 = $auth->company_id;
                $po_price_rule->price_rule_supplier_uuid   = $price_rule_supplier_detail->price_rule_supplier_uuid;
                $po_price_rule->bp_order_uuid              = $order->uuid;
                $po_price_rule->rule_name                  = $price_rule_supplier->rule_name;
                $po_price_rule->rate                       = $price_rule_supplier->rate;
                $po_price_rule->date_start                 = $price_rule_supplier->date_start;
                $po_price_rule->date_end                   = $price_rule_supplier->date_end;
                $po_price_rule->mechanics                  = $price_rule_supplier->mechanics;
                $po_price_rule->target_amount              = $price_rule_supplier->target_amount;
                $po_price_rule->deleted_at = null;
                $po_price_rule->save();


                $po_price_rule_detail = PurchasePriceRuleDetail::where('bp_order_uuid','=',$order->uuid)
                    ->where('bp_price_rule_uuid','=',$po_price_rule->uuid)
                    ->withTrashed()
                    ->first();

                $po_price_rule_detail = ($po_price_rule_detail) ? $po_price_rule_detail : new PurchasePriceRuleDetail;
                $po_price_rule_detail->company_id                  = $auth->company_id;
                $po_price_rule_detail->bp_order_uuid               = $order->uuid;
                $po_price_rule_detail->bp_price_rule_uuid          = $po_price_rule->uuid;
                $po_price_rule_detail->supplier_uuid               = $price_rule_supplier_detail->supplier_uuid;
                $po_price_rule_detail->applied_to                  = $price_rule_supplier_detail->applied_to;
                $po_price_rule_detail->deleted_at = null;
                $po_price_rule_detail->save();
                
                
                foreach ($items as $item) {
                    $item = (object) $item;

                    $price_rule_supplier_item = PriceRuleSupplierItem::where('item_uuid','=',$item->uuid)->where('price_rule_supplier_detail_uuid','=',$price_rule_supplier_detail->uuid)->first();

                    if (!$price_rule_supplier_item) {
                        continue;
                    }
                    
                    $po_price_rule_item = PurchasePriceRuleItem::where('bp_order_uuid','=',$order->uuid)
                        ->where('bp_price_rule_detail_uuid','=',$po_price_rule_detail->uuid)
                        ->where('item_uuid','=',$item->uuid)
                        ->withTrashed()
                        ->first();


                    $po_price_rule_item = ($po_price_rule_item) ? $po_price_rule_item : new PurchasePriceRuleItem;
                    $po_price_rule_item->company_id                    = $auth->company_id;
                    $po_price_rule_item->bp_order_uuid                 = $order->uuid;
                    $po_price_rule_item->bp_price_rule_detail_uuid     = $po_price_rule_detail->uuid;
                    $po_price_rule_item->item_uuid                     = $item->uuid;
                    $po_price_rule_item->deleted_at = null;
                    $po_price_rule_item->save();
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