<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 


use App\Models\CompanyList;
use App\Models\CompanyBranch;
use App\Models\CompanyBranchLocation;
 
use App\Models\ItemList;  
use App\Models\ItemSupplier; 
use App\Models\ItemSupplierDiscount; 
use App\Models\ItemUom; 

use App\Models\SupplierList;  
use App\Models\SupplierRegularDiscount;   
use App\Models\SupplierBaseDiscountGroup;
use App\Models\SupplierBaseDiscountGroupDetail;

use App\Models\PriceRuleSupplier;  
use App\Models\PriceRuleSupplierDetail;  
use App\Models\PriceRuleSupplierItem;  

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

use Illuminate\Support\Facades\Auth;

use DB;

class PurchaseOrderController extends Controller
{
    public function getOrders()
    {
        $lists = PurchaseOrder::whereNull('deleted_at')->with('Supplier')->with('OrderReasonCode')
        ->with('ItemGroup')->with('ItemAssetGroup')->with('Branch')->with('BranchLocation');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $lists = $lists->where(function($query) use ($keyword) {
                $query->where('po_no','LIKE','%'.$keyword.'%');
            });
        }

        $count = $lists->count();

        // pagination
        $take = (is_numeric(request()->take) && request()->take <= 100) ? request()->take: 20;
        $page = (is_numeric(request()->page)) ? request()->page : 1;
        $offset = (($page - 1 ) * $take);

        $lists = $lists->take($take);
        $lists = $lists->offset($offset);
        $lists = $lists->get();


        $x = 0;
        $grand_total = 0;
        
        foreach ($lists as $order) {

            $total_discount = PurchaseOrderAdditionalDiscount::whereNull('deleted_at')
            ->where('bp_order_uuid','=',$order->uuid)
            ->sum('discount_fixed');

            $total_amount = PurchaseOrderDetail::whereNull('deleted_at')
            ->where('bp_order_uuid','=',$order->uuid)
            ->sum('total_amount');
            $lists[$x]['po_total_amount'] = $total_amount - $total_discount;
            $grand_total = $grand_total + ($total_amount - $total_discount);
            $x++;
        }
        
        return response()->json(['success' => 1, 'rows' => $lists, 'count' => $count, 'grand_total' => $grand_total], 200);
    }

    public function saveOrder()
    {
        $auth = \Auth::user();
        
        $order = PurchaseOrder::find(request()->uuid);
        $is_new =  ($order) ? false : true ;
        $order = ($order) ? $order: new PurchaseOrder();

        $order->company_id = $auth->company_id;

        if ($is_new){
            $prefix = $this->getCompanyPrefix();
            $type = 'PO';
            $no_of_transactions = $this->getNumberOfTransactions(request()->uuid) + 1;
            $year = date('Y');
            $month = date('m');
            $day = date('d');
            $id = sprintf($type.'_'.$prefix.''.$year.''.$month.''.$day.'%05d',$no_of_transactions);
            
            $order->po_no = $id;
        }

        $order->item_group_uuid = request()->item_group_uuid;
        $order->asset_group_uuid = request()->asset_group_uuid;
        $order->term = request()->term;
        $order->date_purchased = request()->date_purchased;
        $order->date_expected = request()->date_expected;
        $order->supplier_uuid = request()->supplier_uuid;
        $order->po_status = request()->po_status;
        $order->orders_reason_code_uuid = request()->orders_reason_code_uuid;
        $order->is_apply_tax = request()->is_apply_tax;
        $order->branch_uuid = request()->branch_uuid;
        $order->branch_locations_uuid = request()->branch_locations_uuid;
        $order->save();

        $order = PurchaseOrder::find($order->uuid);

        $this->saveBaseDiscounts($order);
        $this->saveAdditionalDiscount($order);
        $this->savePriceRuleDiscounts($order);

        $po_date = date('Y-m-d',strtotime(request()->date_purchased));

        return response()->json(['success' => 1, 'data' => $order, 'po_date' => $po_date], 200);
    }

    public function updateOrderReasonCode()
    {
        $order =  PurchaseOrder::find(request()->uuid);

        if (!$order) {
            return response()->json(['success' => 0, 'data' => null, 'Order not found'], 500);
        }

        $order->orders_reason_code_uuid = request()->orders_reason_code_uuid;
        $order->save();

        $order = PurchaseOrder::find($order->uuid);
        return response()->json(['success' => 1, 'rows' => $order], 200);
    }
    

    public function getNumberOfTransactions($uuid)
    {
        $auth = \Auth::user();
        $no_of_transactions = PurchaseOrder::whereNull('deleted_at')->where('company_id',$auth->company_id)->whereDate('created_at',date('Y-m-d'))->count();
        return $no_of_transactions;
    }
    

    public function getCompanyPrefix()
    {
        $auth = \Auth::user();
        $prefix = CompanyList::whereNull('deleted_at')->where('id',$auth->company_id)->pluck('prefix')->first();
        return $prefix;
    }

    public function saveBaseDiscounts($order)
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
            $buy_and_pay_order_base_discount_group->company_id = $auth->company_id;
            $buy_and_pay_order_base_discount_group->supplier_uuid = $supplier_base_discount_group->supplier_uuid;
            $buy_and_pay_order_base_discount_group->supplier_base_discount_group_uuid = $supplier_base_discount_group->uuid;
            $buy_and_pay_order_base_discount_group->group_name = $supplier_base_discount_group->group_name;
            $buy_and_pay_order_base_discount_group->deleted_at = null;
            $buy_and_pay_order_base_discount_group->save();

            $supplier_base_discount_group_details = SupplierBaseDiscountGroupDetail::where('supplier_base_discount_group_uuid','=',$supplier_base_discount_group->uuid)->get();
            
            foreach ($supplier_base_discount_group_details as $supplier_base_discount_group_detail) {

                $buy_and_pay_order_base_discount_group_detail = PurchaseOrderBaseDiscountGroupDetail::where('bp_order_uuid','=', $order->uuid)
                    ->where('bp_order_base_discount_group_uuid','=', $buy_and_pay_order_base_discount_group->uuid)
                    ->withTrashed()
                    ->first();

                $buy_and_pay_order_base_discount_group_detail = ($buy_and_pay_order_base_discount_group_detail) ? $buy_and_pay_order_base_discount_group_detail : new PurchaseOrderBaseDiscountGroupDetail;

                $buy_and_pay_order_base_discount_group_detail->company_id = $auth->company_id;
                $buy_and_pay_order_base_discount_group_detail->bp_order_base_discount_group_uuid = $buy_and_pay_order_base_discount_group->uuid;
                $buy_and_pay_order_base_discount_group_detail->bp_order_uuid = $order->uuid;
                $buy_and_pay_order_base_discount_group_detail->discount_name = $supplier_base_discount_group_detail->discount_name;
                $buy_and_pay_order_base_discount_group_detail->discount_rate = $supplier_base_discount_group_detail->discount_rate;
                $buy_and_pay_order_base_discount_group_detail->deleted_at = null;
                $buy_and_pay_order_base_discount_group_detail->save();
                
                // ItemSupplierDiscount to be changed to SupplierBaseDiscountGroupItem 
                $supplier_base_discount_group_items = ItemSupplierDiscount::where('supplier_base_discount_group_uuid','=',$supplier_base_discount_group_detail->supplier_base_discount_group_uuid)->get();

                foreach ($supplier_base_discount_group_items as $supplier_base_discount_group_item) {

                    $buy_and_pay_order_base_discount_group_item = PurchaseOrderBaseDiscountGroupItem::where('bp_order_uuid','=', $order->uuid)
                        ->where('bp_order_base_discount_group_detail_uuid','=',$buy_and_pay_order_base_discount_group_detail->uuid)
                        ->withTrashed()
                        ->first();

                    $buy_and_pay_order_base_discount_group_item = new PurchaseOrderBaseDiscountGroupItem;

                    $buy_and_pay_order_base_discount_group_item->company_id = $auth->company_id;
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

    public function saveAdditionalDiscount($order)
    {
        $auth = \Auth::user();

        $defaults = [];
        $defaults[] = [ 'discount_name' => 'Price Off Discount','discount_type' =>  'rate','discount_rate' => 0.00,'discount_fixed' => 0.00];
        $defaults[] = [ 'discount_name' => 'Volume Discount','discount_type' =>  'rate','discount_rate' => 0.00,'discount_fixed' => 0.00];
        $defaults[] = [ 'discount_name' => 'Move-out Discount','discount_type' => 'rate','discount_rate' => 0.00,'discount_fixed' => 0.00];
        $defaults[] = [ 'discount_name' => 'Seasonal Discount','discount_type' =>  'rate','discount_rate' => 0.00,'discount_fixed' => 0.00];
        $defaults[] = [ 'discount_name' => 'Other Peso Discount','discount_type' => 'fixed','discount_rate' => 0.00,'discount_fixed' => 0.00];

        $discounts = $defaults;
        
        $orderUUID = $order->uuid;

        $order = PurchaseOrder::find($orderUUID);
        $delete = PurchaseOrderAdditionalDiscount::where('bp_order_uuid','=',$orderUUID)->delete();

        foreach ($discounts as $discount) {
            $discount = (object) $discount;
            $uuid = (isset($discount->uuid)) ? $discount->uuid : '';
            $additional_discount = PurchaseOrderAdditionalDiscount::where('bp_order_uuid','=',$orderUUID)->where('uuid','=',$uuid)->first();
            $additional_discount = ($additional_discount) ? $discount : new  PurchaseOrderAdditionalDiscount;

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

    public function savePriceRuleDiscounts($order)
    {
        $auth = \Auth::user();
        
        $po_date = date('Y-m-d',strtotime(request()->date_purchased));

        $price_rule_suppliers = PriceRuleSupplier::where('company_id','=',$auth->company_id)
            ->where('date_start','<=',$po_date)
            ->where('date_end','>=',$po_date)
            ->get();

        foreach ($price_rule_suppliers as $price_rule_supplier) {
            
            $buy_and_pay_price_rule = new PurchasePriceRule;
            $buy_and_pay_price_rule->company_id     = $auth->company_id;
            $buy_and_pay_price_rule->price_rule_supplier_uuid   = $price_rule_supplier->uuid;
            $buy_and_pay_price_rule->bp_order_uuid              = $order->uuid;
            $buy_and_pay_price_rule->rule_name                  = $price_rule_supplier->rule_name;
            $buy_and_pay_price_rule->rate                       = $price_rule_supplier->rate;
            $buy_and_pay_price_rule->date_start                 = $price_rule_supplier->date_start;
            $buy_and_pay_price_rule->date_end                   = $price_rule_supplier->date_end;
            $buy_and_pay_price_rule->mechanics                  = $price_rule_supplier->mechanics;
            $buy_and_pay_price_rule->target_amount              = $price_rule_supplier->target_amount;
            $buy_and_pay_price_rule->save();

            $price_rule_supplier_details = PriceRuleSupplierDetail::where('price_rule_supplier_uuid','=',$price_rule_supplier->uuid)->get();

            foreach ($price_rule_supplier_details as $price_rule_supplier_detail) {
                
                $buy_and_pay_price_rule_detail = new PurchasePriceRuleDetail;
                $buy_and_pay_price_rule_detail->company_id                  = $auth->company_id;
                $buy_and_pay_price_rule_detail->bp_order_uuid               = $order->uuid;
                $buy_and_pay_price_rule_detail->bp_price_rule_uuid          = $buy_and_pay_price_rule->uuid;
                $buy_and_pay_price_rule_detail->supplier_uuid               = $price_rule_supplier_detail->supplier_uuid;
                $buy_and_pay_price_rule_detail->applied_to                  = $price_rule_supplier_detail->applied_to;
                $buy_and_pay_price_rule_detail->save();
                
                $price_rule_supplier_items = PriceRuleSupplierItem::where('price_rule_supplier_detail_uuid','=',$price_rule_supplier_detail->uuid)->get();
                
                foreach ($price_rule_supplier_items as $price_rule_supplier_item) {
                    $buy_and_pay_price_rule_item = new PurchasePriceRuleItem;
                    $buy_and_pay_price_rule_item->company_id                    = $auth->company_id;
                    $buy_and_pay_price_rule_item->bp_order_uuid                 = $order->uuid;
                    $buy_and_pay_price_rule_item->bp_price_rule_detail_uuid     = $buy_and_pay_price_rule_detail->uuid;
                    $buy_and_pay_price_rule_item->item_uuid                     = $price_rule_supplier_item->item_uuid;
                    $buy_and_pay_price_rule_item->save();
                }
            }
        }
    }

    public function deleteOrder()
    {
        $orders = PurchaseOrder::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }

    public function getOrderDetails($orderUUID)
    {

        $order = PurchaseOrder::find($orderUUID);
        $supplier = SupplierList::find($order->supplier_uuid);
        $order->supplier = $supplier;

        $branch = CompanyBranch::find($order->branch_uuid);
        $order->branch = $branch;

        $branch_location = CompanyBranchLocation::find($order->branch_locations_uuid);
        $order->branch_location = $branch_location;

        $discount_groups = PurchaseOrderBaseDiscountGroup::where('bp_order_uuid','=',$orderUUID)->get();
        $order->discount_groups = $discount_groups;

        $additional_discounts = PurchaseOrderAdditionalDiscount::where('bp_order_uuid','=',$orderUUID)->get();
        $order->additional_discounts = $additional_discounts;

        $additional_discounts = PurchaseOrderAdditionalDiscount::where('bp_order_uuid','=',$orderUUID)->get();
        $order->additional_discounts = $additional_discounts;

        $base_discounts =  PurchaseOrderBaseDiscountGroupDetail::where('bp_order_uuid','=',$orderUUID)->get();
        $order->base_discounts = $base_discounts;

        $price_rule_discounts =  PurchasePriceRule::where('bp_order_uuid','=',$orderUUID)->get();
        $order->price_rule_discounts = $price_rule_discounts;

       

        return response()->json(['success' => 1, 'data' => $order], 200);
    }

    public function getOrderSupplierItems($orderUUID)
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

