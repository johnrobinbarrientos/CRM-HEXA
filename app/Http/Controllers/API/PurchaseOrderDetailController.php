<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\PurchaseOrder; 
use App\Models\PurchaseOrderDetail; 
use App\Models\PurchaseOrderAdditionalDiscount; 

use Illuminate\Support\Facades\Auth; 

class PurchaseOrderDetailController extends Controller
{
    public function getOrderDetails()
    {
        $orders = PurchaseOrderDetail::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $orders], 200);
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
    
        $delete = PurchaseOrderDetail::where('bp_order_uuid','=',$orderUUID)->whereNotIn('barcode',$barcodes)->delete();

        foreach ($items as $item) {
            $item = (object) $item;

            $order_detail = PurchaseOrderDetail::where('bp_order_uuid','=',$orderUUID)->where('item_uuid','=',$item->uuid)->where('barcode','=',$item->barcode)->withTrashed()->first();
            $order_detail = ($order_detail) ? $order_detail : new PurchaseOrderDetail;

            $order_detail->company_id               = $auth->company_id;
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

    public function deleteOrderDetail()
    {
        $orders = PurchaseOrderDetail::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}