<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyList;
use App\Models\CompanyBranch;
use App\Models\CompanyBranchLocation;
 
use App\Models\ItemList;
use App\Models\ItemGroup;
use App\Models\ItemAssetGroup;
use App\Models\ItemSupplier; 
use App\Models\SupplierBaseDiscountGroupItem; 
use App\Models\ItemUom; 

use App\Models\SupplierList;  
use App\Models\SupplierRegularDiscount;   
use App\Models\SupplierBaseDiscountGroup;
use App\Models\SupplierBaseDiscountGroupDetail;

use App\Models\PriceRuleSupplier;  
use App\Models\PriceRuleSupplierDetail;  
use App\Models\PriceRuleSupplierItem;  

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\PurchaseOrderSupplierBaseDiscountGroup;

use App\Models\PurchaseOrderAdditionalDiscount; 
use App\Models\PurchaseOrderBaseDiscountGroup; 
use App\Models\PurchaseOrderBaseDiscountGroupDetail; 
use App\Models\PurchaseOrderBaseDiscountGroupItem; 

use App\Models\PurchasePriceRule;  
use App\Models\PurchasePriceRuleDetail;  
use App\Models\PurchasePriceRuleItem; 

use Illuminate\Support\Facades\Auth; 

class BuyAndPayReceiveController extends Controller
{

    public function show($orderUUID)
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

        $base_discounts =  PurchaseOrderBaseDiscountGroupDetail::where('bp_order_uuid','=',$orderUUID)->get();
        $order->base_discounts = $base_discounts;

        $price_rule_discounts =  PurchasePriceRule::where('bp_order_uuid','=',$orderUUID)->with('PriceRuleDetail')->get();
        $order->price_rule_discounts = $price_rule_discounts;

        $item_group = ItemGroup::find($order->item_group_uuid);
        $order->item_group = $item_group;

        $asset_group = ItemAssetGroup::find($order->asset_group_uuid);
        $order->asset_group = $asset_group;

        return response()->json(['success' => 1, 'data' => $order], 200);
    }

    public function save($orderUUID)
    {
        $formData = (object) request()->data;

        $order = PurchaseOrder::find($orderUUID);

        if ($formData->po_status == 'To Receive'){

            $prefix = $this->getCompanyPrefix();
            $type = 'IR';
            $no_of_transactions = $this->getNumberOfTransactions($orderUUID) + 1;
            $year = date('Y');
            $month = date('m');
            $day = date('d');
            $created_id = sprintf($type.'_'.$prefix.''.$year.''.$month.''.$day.'%05d',$no_of_transactions);
            
            
            $order->receiving_no = $created_id;
            $order->date_received = date('Y-m-d',strtotime($formData->date_received));
            $order->receiving_reason_code = $formData->receiving_reason_code;
            $order->receiving_status = 'To Bill';
        } 

        $order->receiving_reason_code = $formData->receiving_reason_code;

        $po_status = ($formData->receiving_reason_code =='Under Served' || $formData->receiving_reason_code =='Over Served') ? 'Partially Received' : 'Fully Received';
        
        $order->po_status = $po_status;
        $order->save();

        return response()->json(['success' => 1, 'message' => 'success', 'data' => $order], 200);
    }

    public function getCompanyPrefix()
    {
        $auth = \Auth::user();
        $prefix = CompanyList::whereNull('deleted_at')
        //->where('id',$auth->company_id)
        ->pluck('prefix')
        ->first();

        return $prefix;
    }

    public function getNumberOfTransactions($uuid)
    {
        $auth = \Auth::user();
        $no_of_transactions = PurchaseOrder::whereNull('deleted_at')
        //->where('company_id',$auth->company_id)
        ->where('receiving_no','!=','')
        ->whereDate('created_at',date('Y-m-d'))->count();

        return $no_of_transactions;
    }
}