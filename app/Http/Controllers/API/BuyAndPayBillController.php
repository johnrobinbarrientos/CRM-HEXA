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

use App\Models\PurchaseBilling; 
use App\Models\PurchaseBillingExpense; 



use Illuminate\Support\Facades\Auth; 

class BuyAndPayBillController extends Controller
{

    public function index()
    {
        $lists = PurchaseBilling::whereNull('deleted_at')
            ->with('Supplier')
            ->with('Branch')
            ->with('BranchLocation');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $lists = $lists->where(function($query) use ($keyword) {
                $query->where('transaction_no','LIKE','%'.$keyword.'%');
            });
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
    
        foreach ($lists as $bill) {
            $lists[$x]['po_total_amount'] = $bill->amount;
            $grand_total = $grand_total + $bill->amount;;
            $x++;
        }
        
        return response()->json(['success' => 1, 'rows' => $lists, 'count' => $count, 'grand_total' => $grand_total, 'offset' => $offset, 'results' => count($lists)], 200);
    }

    public function show($uuid)
    {
        $is_billed = (isset(request()->billed) && request()->billed == 'no') ? false : true ;
        // if billing is from PO and not "billed" yet, meaning no bill record has been generated yet
        if (!$is_billed) {
            $orderUUID = $uuid;
            $order = PurchaseOrder::where('uuid','=',$orderUUID)->first();

            if (!$order) {
                return response()->json(['success' => 0, 'message' => 'billing not found!'], 200);
            }

        
            $supplier = SupplierList::with('VAT')->with('EWT')->find($order->supplier_uuid);
            $order->supplier = $supplier;

            $branch = CompanyBranch::find($order->branch_uuid);
            $order->branch = $branch;

            $branch_location = CompanyBranchLocation::find($order->branch_locations_uuid);
            $order->branch_location = $branch_location;


            // dummy data for billing for non-existing billing
            $data = ['id' => null, 'uuid' => null, 'transaction_type' => 'Inventory', 'supplier' => $supplier, 'branch' => $branch, 'branch_location' => $branch_location];
            $bill = (object) $data;

        } else {
            $billingUUID = $uuid;
            $bill = PurchaseBilling::find($billingUUID);

            if (!$bill) {
                return response()->json(['success' => 0, 'message' => 'billing not found!'], 200);
            }

            $supplier = SupplierList::with('VAT')->with('EWT')->find($bill->supplier_uuid);
            $bill->supplier = $supplier;

            $branch = CompanyBranch::find($bill->branch_uuid);
            $bill->branch = $branch;

            $branch_location = CompanyBranchLocation::find($bill->branch_locations_uuid);
            $bill->branch_location = $branch_location;

            $order = PurchaseOrder::where('billing_no','=',$bill->transaction_no)->first();
        }

        if ($bill->transaction_type == 'Inventory') {
      
            $order = ($order) ? $order : PurchaseOrder::where('billing_no','=',$bill->transaction_no)->first();
            $orderUUID = $order->uuid;
            
            
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

            $order->term = $order->term;

            $branch = CompanyBranch::find($order->branch_uuid);
            $order->branch = $branch;

            $branch_location = CompanyBranchLocation::find($order->branch_locations_uuid);
            $order->branch_location = $branch_location;


            $bill->order = $order;
        }
        

        return response()->json(['success' => 1, 'data' => $bill], 200);
    }

    

    public function store()
    {
        $transaction_type = request()->type;
        $order = null;

        if ($transaction_type == 'Inventory') {
            $order = (object) request()->order;
            $order = PurchaseOrder::find($order->uuid);
        }
        

    
        $prefix = $this->getCompanyPrefix();
        $type = 'BL';
        $no_of_transactions = $this->getNumberOfTransactions() + 1;
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $created_id = sprintf($type.'_'.$prefix.''.$year.''.$month.''.$day.'%05d',$no_of_transactions);

        if ($transaction_type === 'Inventory' && $order && $order->receiving_status == 'To Bill') {
            
            $total_discount = PurchaseOrderAdditionalDiscount::whereNull('deleted_at')
            ->where('bp_order_uuid','=',$order->uuid)
            ->sum('discount_fixed');

            $total_amount = PurchaseOrderItem::whereNull('deleted_at')
            ->where('bp_order_uuid','=',$order->uuid)
            ->sum('total_amount');

            $po_amount = $total_amount - $total_discount;

           
            $bill = new PurchaseBilling;
            $bill->transaction_no =  $created_id;      
            $bill->supplier_uuid = $order->supplier_uuid;        
            $bill->branch_uuid = $order->branch_uuid;     
            $bill->branch_location_uuid = $order->branch_locations_uuid;    
            $bill->amount = $po_amount; 
            $bill->transaction_type = $transaction_type;    
            $bill->transaction_date = date('Y-m-d');  
            $bill->status = 'To Pay';  
            $bill->save();
            
            $order->billing_no = $created_id;
            $order->billing_status = 'To Pay';
            $order->receiving_status = 'Billed';
            $order->save();

            $bill = PurchaseBilling::find($bill->uuid);

            return response()->json(['success' => 1, 'message' => 'success', 'data' => $bill], 200);

        } else if ($transaction_type == 'Expenses') {

            $formdata = (object) request()->data; 
            $bill = new PurchaseBilling;
            $bill->transaction_no =  $created_id;      
            $bill->supplier_uuid = $formdata->supplier_uuid;        
            $bill->branch_uuid =  $formdata->branch_uuid;     
            $bill->branch_location_uuid = $formdata->branch_location_uuid;     
            $bill->amount = $formdata->amount;    
            $bill->transaction_type = $transaction_type;    
            $bill->transaction_date = date('Y-m-d');  
            $bill->status = 'To Pay';
            $bill->save();

            $bill = PurchaseBilling::find($bill->uuid);

            $this->saveExpenses($bill);

            return response()->json(['success' => 1, 'message' => 'success', 'data' => $bill], 200);
        } else {
            return response()->json(['success' => 0, 'message' => 'error', 'data' => []], 500);
        }
    }

    private function saveExpenses($bill)
    {
        $expenses = (is_array(request()->expenses)) ? request()->expenses : [];

        foreach ($expenses as $expense) {
            $expense = (object) $expense;
            $new = new PurchaseBillingExpense;
            $new->purchase_billing_uuid = $bill->uuid;
            $new->coa_uuid = $expense->coa_uuid;
            $new->project_uuid = $expense->project_uuid;
            $new->amount = $expense->amount;
            $new->memo_1 = $expense->memo_1;
            $new->memo_2 = $expense->memo_2;
            $new->memo_3 = $expense->memo_3;
            $new->save();
        }

        return;
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

    public function getNumberOfTransactions()
    {
        $auth = \Auth::user();
        $no_of_transactions = PurchaseBilling::whereNull('deleted_at')
        //->where('company_id',$auth->company_id)
        ->where('transaction_no','!=','')
        ->whereDate('created_at',date('Y-m-d'))->count();

        return $no_of_transactions;
    }

    public function getExpenses($billingUUID)
    {
        $expenses = PurchaseBillingExpense::where('purchase_billing_uuid','=',$billingUUID)->with('Account')->with('Project')->get();
        return response()->json(['success' => 1, 'message' => 'success', 'rows' => $expenses], 200);
    }
}