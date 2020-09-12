<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\BuyAndPayOrders;
use App\Models\CompanyList;
use App\Models\CompanyBranch;
use App\Models\CompanyBranchLocation;
use App\Models\BuyAndPayOrderDetails;  
use App\Models\ItemGroup;  
use App\Models\ItemDiscountGroup;  
use App\Models\SupplierList;  
use App\Models\SupplierRegularDiscount;  
use App\Models\SupplierPriceRule;  
use App\Models\BuyAndPayOrderRegularDiscount;  
use App\Models\BuyAndPayOrderPriceRuleDiscount;  
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


        $item_discount_group = ItemDiscountGroup::where('company_id','=',$auth->company_id)->where('uuid',request()->item_discount_group_uuid)->first();

        if (!$item_discount_group) {
            return response()->json(['success' => 0, 'message' =>  'Invalid item discount group...'], 500);
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

        // discounts

        // save item group discount
        $discount = new BuyAndPayOrderRegularDiscount;
        $discount->company_id = $auth->company_id;
        $discount->bp_order_uuid = $orders->uuid;
        $discount->discount_type = $item_discount_group->discount_type;
        $discount->discount_name = $item_discount_group->group_name;
        $discount->discount_rate = $item_discount_group->discount_rate;
        $discount->discount_fixed = $item_discount_group->discount_fixed;
        $discount->save();

        // active supplier regular discounts
        $supplier_discount_groups = SupplierRegularDiscount::where('supplier_uuid','=',$orders->supplier_uuid)->where('company_id','=',$auth->company_id)->where('is_active','=',true)->get();

        foreach ($supplier_discount_groups as $supplier_discount_group) {
            $discount = new BuyAndPayOrderRegularDiscount;
            $discount->company_id = $auth->company_id;
            $discount->bp_order_uuid = $orders->uuid;
            $discount->discount_type = $supplier_discount_group->discount_type;
            $discount->discount_name = $supplier_discount_group->discount_name;
            $discount->discount_rate = $supplier_discount_group->discount_rate;
            $discount->discount_fixed = $supplier_discount_group->discount_fixed;
            $discount->save();
        }

        $po_date = date('Y-m-d',strtotime($orders->date_purchased));

        // active supplier price rules discounts
        $supplier_discount_price_rules = SupplierPriceRule::where('supplier_uuid','=',$orders->supplier_uuid)
            ->where('company_id','=',$auth->company_id)
            ->where('date_start','<=',$po_date)
            ->where('date_end','>=',$po_date)
            ->get();

        foreach ($supplier_discount_price_rules as $supplier_discount_price_rule) {
            $discount = new BuyAndPayOrderPriceRuleDiscount;
            $discount->company_id = $auth->company_id;
            $discount->bp_order_uuid = $orders->uuid;
            $discount->discount_type = $supplier_discount_price_rule->discount_type;
            $discount->discount_name = $supplier_discount_price_rule->discount_name;
            $discount->discount_rate = $supplier_discount_price_rule->discount_rate;
            $discount->discount_fixed = $supplier_discount_price_rule->discount_fixed;
            $discount->save();
        }

        return response()->json(['success' => 1, 'rows' => $orders, 'po_date' => $po_date], 200);
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
        
        $discounts = BuyAndPayOrderRegularDiscount::where('bp_order_uuid','=',$order->uuid)->get();
        $order->discounts = $discounts;

        $price_rules = BuyAndPayOrderPriceRuleDiscount::where('bp_order_uuid','=',$order->uuid)->get();
        $order->price_rules = $price_rules;

        $supplier = SupplierList::find($order->supplier_uuid);
        $order->supplier = $supplier;

        $item_group = ItemGroup::find($order->item_group_uuid);
        $order->item_group = $item_group;

        $branch = CompanyBranch::find($order->branch_uuid);
        $order->branch = $branch;

        $branch_location = CompanyBranchLocation::find($order->branch_locations_uuid);
        $order->branch_location = $branch_location;

        return response()->json(['success' => 1, 'data' => $order], 200);
    }
}