<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\BuyAndPayOrders; 
use Illuminate\Support\Facades\Auth; 

class BuyAndPayOrdersController extends Controller
{
    public function getOrders()
    {
        $orders = BuyAndPayOrders::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $po], 200);
    }

    public function saveOrder()
    {
        $orders = request()->uuid ? BuyAndPayOrders::find(request()->uuid) : new BuyAndPayOrders();
        $auth = \Auth::user();
        $orders->company_id = $auth->company_id;
        $orders->po_no = request()->po_no;
        $orders->item_group_uuid = request()->item_group_uuid;
        $orders->asset_group_uuid = request()->asset_group_uuid;
        $orders->date_purchased = request()->date_purchased;
        $orders->date_expected = request()->date_expected;
        $orders->supplier_uuid = request()->supplier_uuid;
        $orders->status = request()->status;
        $orders->orders_reason_code_uuid = request()->orders_reason_code_uuid;
        $orders->save();

        $orders = BuyAndPayOrders::find($orders->uuid);

        return response()->json(['success' => 1, 'rows' => $orders], 200);
    }

    public function deleteOrder()
    {
        $orders = BuyAndPayOrders::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}