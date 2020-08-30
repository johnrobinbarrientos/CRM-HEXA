<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\BuyAndPayOrderDetails; 
use Illuminate\Support\Facades\Auth; 

class BuyAndPayOrderDetailsController extends Controller
{
    public function getOrderDetails()
    {
        $orders = BuyAndPayOrderDetails::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $orders], 200);
    }

    public function saveOrderDetails()
    {
        $orders = request()->uuid ? BuyAndPayOrderDetails::find(request()->uuid) : new BuyAndPayOrderDetails();
        $auth = \Auth::user();
        $orders->company_id = $auth->company_id;
        $orders->bp_order_uuid = request()->bp_order_uuid;
        $orders->location_uuid = request()->location_uuid;
        $orders->order_qty = request()->order_qty;
        $orders->order_accepted = request()->order_accepted;
        $orders->uom = request()->uom;
        $orders->item_rate = request()->item_rate;
        $orders->save();

        $orders = BuyAndPayOrderDetails::find($orders->uuid);

        return response()->json(['success' => 1, 'rows' => $orders], 200);
    }

    public function deleteOrderDetail()
    {
        $orders = BuyAndPayOrderDetails::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}