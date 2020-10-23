<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\BuyAndPayOrder; 
use App\Models\BuyAndPayOrderDetail; 
use App\Models\BuyAndPayOrderAdditionalDiscount; 

use Illuminate\Support\Facades\Auth; 

class BuyAndPayOrderDetailController extends Controller
{
    public function getOrderDetails()
    {
        $orders = BuyAndPayOrderDetail::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $orders], 200);
    }

    public function save($orderUUID)
    {
        $auth = \Auth::user();
        $items = (is_array(request()->items)) ? request()->items : [];
     
        $delete = BuyAndPayOrderDetail::where('bp_order_uuid','=',$orderUUID)->delete();
        
        $order = BuyAndPayOrder::find($orderUUID);
   
        foreach ($items as $item) {
            $item = (object) $item;

            $order_detail = BuyAndPayOrderDetail::where('bp_order_uuid','=',$orderUUID)->where('item_uuid','=',$item->uuid)->where('barcode','=',$item->barcode)->withTrashed()->first();
            $order_detail = ($order_detail) ? $order_detail : new BuyAndPayOrderDetail;

            $order_detail->company_id               = $auth->company_id;
            $order_detail->bp_order_uuid            = $order->uuid;
            $order_detail->item_uuid                = $item->uuid;
            $order_detail->barcode                  = $item->barcode;
            $order_detail->branch_location_uuid     = $order->branch_locations_uuid;
            $order_detail->order_qty                = $item->quantity;
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

    public function saveAdditionalDiscount($orderUUID)
    {
        $auth = \Auth::user();
        $discounts = (is_array(request()->discounts)) ? request()->discounts : [];
        $order = BuyAndPayOrder::find($orderUUID);
        $delete = BuyAndPayOrderAdditionalDiscount::where('bp_order_uuid','=',$orderUUID)->delete();

        foreach ($discounts as $discount) {
            $discount = (object) $discount;

            $additional_discount = BuyAndPayOrderAdditionalDiscount::where('bp_order_uuid','=',$orderUUID)->where('uuid','=',$discount->uuid)->first();
            $additional_discount = ($additional_discount) ? $discount : new  BuyAndPayOrderAdditionalDiscount;

            $additional_discount->company_id               = $auth->company_id;
            $additional_discount->bp_order_uuid            = $order->uuid;
            $additional_discount->discount_name            = $discount->discount_name;
            $additional_discount->discount_type            = $discount->discount_type;
            $additional_discount->discount_rate            = $discount->discount_rate;
            $additional_discount->discount_fixed           = $discount->discount_fixed;
            $additional_discount->deleted_at               = null;
            $additional_discount->save();
        }

        $additional_discounts = BuyAndPayOrderAdditionalDiscount::where('bp_order_uuid','=',$orderUUID)->get();

        return response()->json(['success' => 1, 'rows' => $additional_discounts], 200);
    }

    public function deleteOrderDetail()
    {
        $orders = BuyAndPayOrderDetail::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}