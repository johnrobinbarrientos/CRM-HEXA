<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\BuyAndPayOrderDetail; 
use Illuminate\Support\Facades\Auth; 

class BuyAndPayOrderDetailController extends Controller
{
    public function getOrderDetails()
    {
        $orders = BuyAndPayOrderDetail::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $orders], 200);
    }

    public function saveOrderDetails()
    {
        $orders = request()->uuid ? BuyAndPayOrderDetail::find(request()->uuid) : new BuyAndPayOrderDetail();
        $auth = \Auth::user();
        $orders->company_id = $auth->company_id;
        $orders->bp_order_uuid = request()->bp_order_uuid;
        $orders->location_uuid = request()->location_uuid;
        $orders->order_qty = request()->order_qty;
        $orders->order_accepted = request()->order_accepted;
        $orders->uom = request()->uom;
        $orders->item_rate = request()->item_rate;
        $orders->save();

        $orders = BuyAndPayOrderDetail::find($orders->uuid);

        return response()->json(['success' => 1, 'rows' => $orders], 200);
    }

    public function deleteOrderDetail()
    {
        $orders = BuyAndPayOrderDetail::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}