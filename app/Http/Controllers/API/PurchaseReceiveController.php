<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\PurchaseOrderAdditionalDiscount; 
use Illuminate\Support\Facades\Auth; 

class PurchaseReceiveController extends Controller
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
        foreach ($lists as $order) {

            $total_discount = PurchaseOrderAdditionalDiscount::whereNull('deleted_at')
            ->where('bp_order_uuid','=',$order->uuid)
            ->sum('discount_fixed');

            $total_amount = PurchaseOrderDetail::whereNull('deleted_at')
            ->where('bp_order_uuid','=',$order->uuid)
            ->sum('total_amount');
            $lists[$x]['po_total_amount'] = $total_amount - $total_discount;
            $x++;
        }
        
        return response()->json(['success' => 1, 'rows' => $lists, 'count' => $count], 200);
    }

    
}