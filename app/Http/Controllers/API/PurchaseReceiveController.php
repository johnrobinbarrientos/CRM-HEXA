<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\PurchaseOrderAdditionalDiscount; 
use Illuminate\Support\Facades\Auth; 

class PurchaseReceiveController extends Controller
{
    public function getReceived()
    {
        $lists = PurchaseOrder::whereNull('deleted_at')->with('Supplier')->with('OrderReasonCode')
        ->with('ItemGroup')->with('ItemAssetGroup')->with('Branch')->with('BranchLocation')
        ->where('receiving_status','To Bill')->orWhere('receiving_status','Billed');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $lists = $lists->where(function($query) use ($keyword) {
                $query->where('po_no','LIKE','%'.$keyword.'%');
            });
        }

        if (!empty(request()->item_group)) {
            $lists = $lists->where('item_group_uuid','=',request()->item_group);
        }

        if (!empty(request()->supplier)) {
            $lists = $lists->where('supplier_uuid','=',request()->supplier);
        }

        if (!empty(request()->reason_code)) {
            $lists = $lists->where('orders_reason_code_uuid','=',request()->reason_code);
        }


        if (!empty(request()->branch)) {
            $lists = $lists->where('branch_uuid','=',request()->branch);
        }

        if (!empty(request()->branch_location)) {
            $lists = $lists->where('branch_locations_uuid','=',request()->branch_location);
        }

        if (!empty(request()->status)) {
            $lists = $lists->where('po_status','=',request()->status);
        }

        if (!empty(request()->from) && !empty(request()->to)) {
            $lists = $lists->where(function ($query) {
                $query->where('date_purchased','>=',request()->from)
                    ->where('date_purchased','<=',request()->to);
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

            $total_amount = PurchaseOrderItem::whereNull('deleted_at')
            ->where('bp_order_uuid','=',$order->uuid)
            ->sum('total_amount');
            $lists[$x]['po_total_amount'] = $total_amount - $total_discount;
            $grand_total = $grand_total + ($total_amount - $total_discount);
            $x++;
        }
        
        return response()->json(['success' => 1, 'rows' => $lists, 'count' => $count, 'grand_total' => $grand_total], 200);
    }

    public function getToReceive()
    {
        $lists = PurchaseOrder::whereNull('deleted_at')->with('Supplier')->with('OrderReasonCode')
        ->with('ItemGroup')->with('ItemAssetGroup')->with('Branch')->with('BranchLocation')
        ->where('po_status','To Receive');

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

            $total_amount = PurchaseOrderItem::whereNull('deleted_at')
            ->where('bp_order_uuid','=',$order->uuid)
            ->sum('total_amount');
            $lists[$x]['po_total_amount'] = $total_amount - $total_discount;
            $grand_total = $grand_total + ($total_amount - $total_discount);
            $x++;
        }
        
        return response()->json(['success' => 1, 'rows' => $lists, 'count' => $count, 'grand_total' => $grand_total], 200);
    }

    
}