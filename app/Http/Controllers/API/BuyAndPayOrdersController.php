<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\BuyAndPayOrders;
use App\Models\CompanyList;
use App\Models\BuyAndPayOrderDetails;  
use Illuminate\Support\Facades\Auth; 

class BuyAndPayOrdersController extends Controller
{
    public function getOrders()
    {
        $orders = BuyAndPayOrders::whereNull('deleted_at')->with('Supplier')->with('ItemGroup')->with('OrderReasonCode')->with('ItemAssetGroup')->get();
        return response()->json(['success' => 1, 'rows' => $orders], 200);
    }

    public function saveOrder()
    {
        $orders = request()->uuid ? BuyAndPayOrders::find(request()->uuid) : new BuyAndPayOrders();
        $auth = \Auth::user();
        $orders->company_id = $auth->company_id;

        if (request()->uuid===null){
            $prefix = $this->getCompanyPrefix();
            $type = 'PO';
            $no_of_transactions = $this->getNumberOfTransactions(request()->uuid) + 1;
            $year = date('Y');
            $month = date('m');
            $day = date('d');
            $id = sprintf($type.'_'.$prefix.''.$year.''.$month.''.$day.'%05d',$no_of_transactions);
            
            $orders->po_no = $id;
        }

        $orders->item_group_uuid = request()->item_group_uuid;
        $orders->asset_group_uuid = request()->asset_group_uuid;
        $orders->item_discount_group_uuid = request()->item_discount_group_uuid;
        $orders->term = request()->term;
        $orders->date_purchased = request()->date_purchased;
        $orders->date_expected = request()->date_expected;
        $orders->supplier_uuid = request()->supplier_uuid;
        $orders->status = request()->status;
        $orders->orders_reason_code_uuid = request()->orders_reason_code_uuid;
        $orders->is_apply_tax = request()->is_apply_tax;
        $orders->branch_uuid = request()->branch_uuid;
        $orders->branch_locations_uuid = request()->branch_locations_uuid;
        $orders->save();

        $orders = BuyAndPayOrders::find($orders->uuid);

        return response()->json(['success' => 1, 'rows' => $orders], 200);
    }

    public function getNumberOfTransactions($uuid)
    {
        $auth = \Auth::user();
        $no_of_transactions = BuyAndPayOrders::whereNull('deleted_at')->where('company_id',$auth->company_id)->whereDate('created_at',date('Y-m-d'))->count();
        return $no_of_transactions;
    }
    

    public function getCompanyPrefix()
    {
        $auth = \Auth::user();
        $prefix = CompanyList::whereNull('deleted_at')->where('id',$auth->company_id)->pluck('prefix')->first();
        return $prefix;
    }


    public function deleteOrder()
    {
        $orders = BuyAndPayOrders::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }

    public function getOrderDetails($order_uuid)
    {
        $order = BuyAndPayOrders::find($order_uuid);
        return response()->json(['success' => 1, 'data' => $order], 200);
    }
}