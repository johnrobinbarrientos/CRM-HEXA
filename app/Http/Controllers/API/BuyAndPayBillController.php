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
use App\Models\PurchaseBillingProjectExpense;

use App\Models\ProjectList;
use App\Models\ProjectScope;
use App\Models\ProjectScopeDetail;


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
            $lists = $lists->where('status','=',request()->status);
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

    public function draft()
    {
        $type = request()->type;

        if ($type == 'Inventory') {
            $orderUUID = request()->order;
            $order = PurchaseOrder::where('uuid','=',$orderUUID)->where('receiving_status','=','To Bill')->first();

            if (!$order) {
                return response()->json(['success' => 0, 'message' => 'Order not found!'], 200);
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

            return response()->json(['success' => 1, 'data' => $bill], 200);
        } else {
            $formdata = (object) request()->all(); 
            
            $amount = $formdata->amount;
            $supplier = SupplierList::with('VAT')->with('EWT')->find($formdata->supplier_uuid);
            $branch = CompanyBranch::find($formdata->branch_uuid);
            $branch_location = CompanyBranchLocation::find($formdata->branch_location_uuid);

            $project = ProjectList::find($formdata->project_uuid);
    
            // dummy data for billing for non-existing billing
            $data = ['id' => null, 'uuid' => null, 'transaction_type' => $type, 'supplier' => $supplier, 'branch' => $branch, 'branch_location' => $branch_location, 'project' => $project, 'amount' => $amount];
            $bill = (object) $data;

            return response()->json(['success' => 1, 'data' => $bill], 200);
        }
    }

    public function show($uuid)
    {
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

        if ($bill->transaction_type == 'Inventory') {
      
            $order = PurchaseOrder::where('billing_no','=',$bill->transaction_no)->first();
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

        $prefix = $this->getCompanyPrefix();
        $type = 'BL';
        $no_of_transactions = $this->getNumberOfTransactions() + 1;
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $created_id = sprintf($type.'_'.$prefix.''.$year.''.$month.''.$day.'%05d',$no_of_transactions);

        if ($transaction_type === 'Inventory') {

            $order = (object) request()->order;
            $order = PurchaseOrder::find($order->uuid);
            
            // only allowed to bill orders when status is to bill
            if (!$order || $order->receiving_status != 'To Bill') {
                return response()->json(['success' => 0, 'message' => 'An error occur while processing...']);
            }
            
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

            $formdata = (object) request()->bill; 
            $expenses = request()->expenses;

            $row = 1;
            $error = 0;
            $errors = [];

            foreach ($expenses as $expense) {
                $ex = (object) $expense;

                if (!$ex->coa_uuid || is_null($ex->coa_uuid)) {
                    $errors[] = $row;
                }  

                $row++;
            }

            $count = count($errors);
            if ($count > 0) {
                $message = ($count > 1) ? 'ERROR: check rows '.implode(',',$errors) : 'ERROR: check row '.implode(',',$errors);
                return response()->json(['success' => 0, 'message' => $message], 500);
            }

            $supplier_uuid = $formdata->supplier['uuid'];
            $branch_uuid = $formdata->branch['uuid'];
            $branch_location_uuid = $formdata->branch_location['uuid'];

            $bill = new PurchaseBilling;
            $bill->transaction_no =  $created_id;      
            $bill->supplier_uuid = $supplier_uuid;        
            $bill->branch_uuid =  $branch_uuid;     
            $bill->branch_location_uuid = $branch_location_uuid;     
            $bill->amount = $formdata->amount;    
            $bill->transaction_type = $transaction_type;    
            $bill->transaction_date = date('Y-m-d');  
            $bill->status = 'To Pay';
            $bill->save();

            $bill = PurchaseBilling::find($bill->uuid);
            return response()->json(['success' => 1, 'message' => 'success', 'data' => $bill], 200);
        } else {
            return response()->json(['success' => 0, 'message' => 'error', 'data' => []], 500);
        }
    }

    public function saveBillingExpenses()
    {
        
        $formdata = (object) request()->bill; 

        $bill_uuid = $formdata->uuid;
        $supplier_uuid = $formdata->supplier['uuid'];
        $branch_uuid = $formdata->branch['uuid'];
        $branch_location_uuid = $formdata->branch_location['uuid'];

        $bill = PurchaseBilling::find($bill_uuid);
        $is_new =  ($bill) ? false : true ;
        $bill = ($bill) ? $bill : new PurchaseBilling;

        if ($is_new){

            $prefix = $this->getCompanyPrefix();
            $type = 'BL';
            $no_of_transactions = $this->getNumberOfTransactions() + 1;
            $year = date('Y');
            $month = date('m');
            $day = date('d');
            $created_id = sprintf($type.'_'.$prefix.''.$year.''.$month.''.$day.'%05d',$no_of_transactions);

            $bill->transaction_no =  $created_id;      
            $bill->supplier_uuid = $supplier_uuid;        
            $bill->branch_uuid =  $branch_uuid;     
            $bill->branch_location_uuid = $branch_location_uuid;     
            
            $bill->transaction_type = 'Expenses';    
            $bill->transaction_date = date('Y-m-d');  
            $bill->status = 'To Pay';
        }
        

        $bill->amount = $formdata->amount;
        $bill->save();

        $bill = PurchaseBilling::find($bill->uuid);

        $expenses = (is_array(request()->expenses)) ? request()->expenses : [];

        $expenses_uuids = [];

        foreach ($expenses as $expense) {
            $ex = (object) $expense;
            $expenses_uuids[] = $ex->uuid;    
        }
        
        $delete = PurchaseBillingExpense::where('purchase_billing_uuid','=',$bill->uuid)->whereNotIn('uuid',$expenses_uuids)->delete();

        foreach ($expenses as $expense) {
            $expense = (object) $expense;

            $exists = PurchaseBillingExpense::where('uuid','=',$expense->uuid)->where('purchase_billing_uuid','=',$bill->uuid)->first();

            $new = ($exists) ? $exists : new PurchaseBillingExpense;
            $new->purchase_billing_uuid = $bill->uuid;
            $new->coa_uuid = $expense->coa_uuid;
            $new->amount = $expense->amount;
            $new->memo_1 = $expense->memo_1;
            $new->memo_2 = $expense->memo_2;
            $new->memo_3 = $expense->memo_3;
            $new->deleted_at = null;
            $new->save();
        }

        return response()->json(['success' => 1, 'message' => 'success', 'data' => $bill], 200);

    }

    public function saveBillingProjectExpenses()
    {

        $formdata = (object) request()->bill;

        $bill_uuid = $formdata->uuid;
        $supplier_uuid = $formdata->supplier['uuid'];
        $branch_uuid = $formdata->branch['uuid'];
        $branch_location_uuid = $formdata->branch_location['uuid'];
        $project_uuid = $formdata->project['uuid'];


        $bill = PurchaseBilling::find($bill_uuid);
        $is_new =  ($bill) ? false : true ;
        $bill = ($bill) ? $bill : new PurchaseBilling;

        if ($is_new){

            $prefix = $this->getCompanyPrefix();
            $type = 'BL';
            $no_of_transactions = $this->getNumberOfTransactions() + 1;
            $year = date('Y');
            $month = date('m');
            $day = date('d');
            $created_id = sprintf($type.'_'.$prefix.''.$year.''.$month.''.$day.'%05d',$no_of_transactions);


            $bill->transaction_no =  $created_id;      
            $bill->supplier_uuid = $supplier_uuid;        
            $bill->branch_uuid =  $branch_uuid;     
            $bill->branch_location_uuid = $branch_location_uuid;     
            $bill->project_uuid = $project_uuid;       
            $bill->transaction_date = date('Y-m-d');  
            $bill->status = 'To Pay';
            $bill->transaction_type = 'Expenses';
        }

        $bill->amount = $formdata->amount;  
        $bill->save();

        $bill = PurchaseBilling::find($bill->uuid);

        $expenses = (is_array(request()->expenses)) ? request()->expenses : [];

        $expenses_uuids = [];

        foreach ($expenses as $expense) {
            $ex = (object) $expense;
            $expenses_uuids[] = $ex->uuid;    
        }
        
        $delete = PurchaseBillingProjectExpense::where('purchase_billing_uuid','=',$bill->uuid)->whereNotIn('uuid',$expenses_uuids)->delete();

        foreach ($expenses as $expense) {
            $expense = (object) $expense;

            $exists = PurchaseBillingProjectExpense::where('uuid','=',$expense->uuid)->where('purchase_billing_uuid','=',$bill->uuid)->first();

            $new = ($exists) ? $exists : new PurchaseBillingProjectExpense;
            $new->purchase_billing_uuid = $bill->uuid;
            $new->coa_uuid = $expense->coa_uuid;
            $new->amount = $expense->amount;
            $new->project_scope_uuid = $expense->project_scope_uuid;
            $new->scope_details_uuid = $expense->scope_details_uuid;
            $new->memo_1 = $expense->memo_1;
            $new->deleted_at = null;
            $new->save();
        }

        return response()->json(['success' => 1, 'message' => 'success', 'data' => $bill], 200);

    }

    public function showExpenses($uuid)
    {
        $billingUUID = $uuid;
        $bill = PurchaseBilling::find($billingUUID);

        if (!$bill) {
            return response()->json(['success' => 0, 'message' => 'billing not found!'], 200);
        }

        $supplier = SupplierList::with('VAT')->with('EWT')->find($bill->supplier_uuid);
        $bill->supplier = $supplier;

        $branch = CompanyBranch::find($bill->branch_uuid);
        $bill->branch = $branch;

        $branch_location = CompanyBranchLocation::find($bill->branch_location_uuid);
        $bill->branch_location = $branch_location;


        if($bill->project_uuid!=null){
            $project = ProjectList::find($bill->project_uuid);
            $bill->project = $project;
        }

        return response()->json(['success' => 1, 'data' => $bill], 200);
    }

    public function getExpenses($billingUUID)
    {
        $expenses = PurchaseBillingExpense::where('purchase_billing_uuid','=',$billingUUID)->with('Account')->with('Project')->get();
        return response()->json(['success' => 1, 'message' => 'success', 'rows' => $expenses], 200);
    }

    public function getProjectExpenses($billingUUID)
    {
        $expenses = PurchaseBillingProjectExpense::where('purchase_billing_uuid','=',$billingUUID)->with('Account')->get();

        $x = 0;

        foreach ($expenses as $expense) {

            $expense = (object) $expense;

            $scope_details = ProjectScopeDetail::where('project_scope_uuid','=',$expense->project_scope_uuid)->get();

            $expenses[$x]['scopeDetails'] = $scope_details;
            $expenses[$x]['scope_details'] = [];

            $x++;
        }


        return response()->json(['success' => 1, 'message' => 'success', 'rows' => $expenses], 200);
    }

    

    // public function saveExpenses($billUUID)
    // {
    //     $bill = PurchaseBilling::find($billUUID);

    //     if (!$bill) {
    //         return response()->json(['success' => 0, 'message' => 'Could not find the bill']);
    //     }

    //     $expenses = (is_array(request()->expenses)) ? request()->expenses : [];

    //     $expenses_uuids = [];

    //     foreach ($expenses as $expense) {
    //         $ex = (object) $expense;
    //         $expenses_uuids[] = $ex->uuid;    
    //     }
        
    //     $delete = PurchaseBillingExpense::where('purchase_billing_uuid','=',$billUUID)->whereNotIn('uuid',$expenses_uuids)->delete();

    //     foreach ($expenses as $expense) {
    //         $expense = (object) $expense;

    //         $exists = PurchaseBillingExpense::where('uuid','=',$expense->uuid)->where('purchase_billing_uuid','=',$billUUID)->first();

    //         $new = ($exists) ? $exists : new PurchaseBillingExpense;
    //         $new->purchase_billing_uuid = $billUUID;
    //         $new->coa_uuid = $expense->coa_uuid;
    //         $new->project_uuid = $expense->project_uuid;
    //         $new->amount = $expense->amount;
    //         $new->memo_1 = $expense->memo_1;
    //         $new->memo_2 = $expense->memo_2;
    //         $new->memo_3 = $expense->memo_3;
    //         $new->deleted_at = null;
    //         $new->save();
    //     }

    //     return response()->json(['success' => 1, 'message' => 'saved!']);
    // }

    public function update($billUUID) {

        $transaction_type = request()->type;
        $bill = PurchaseBilling::find($billUUID);

        if (!$bill) {
            return response()->json(['success' => 0, 'message' => 'Could not find the bill']);
        }

        if ($transaction_type === 'Expenses') {

            $formdata = (object) request()->bill; 
            $expenses = request()->expenses;


            $row = 1;
            $error = 0;
            $errors = [];

            foreach ($expenses as $expense) {
                $ex = (object) $expense;

                if (!$ex->coa_uuid || is_null($ex->coa_uuid)) {
                    $errors[] = $row;
                }  

                $row++;
            }

            $count = count($errors);
            if ($count > 0) {
                $message = ($count > 1) ? 'ERROR: check rows '.implode(',',$errors) : 'ERROR: check row '.implode(',',$errors);
                return response()->json(['success' => 0, 'message' => $message], 500);
            }

            $bill->amount = $formdata->amount; 
            $bill->save();
        }

        return response()->json(['success' => 1, 'message' => 'success', 'data' => $bill], 200);
    } 

    public function cancel($billUUID)
    {
        $bill = PurchaseBilling::find($billUUID);

        if (!$bill) {
            return response()->json(['success' => 0, 'message' => 'Could not find the bill']);
        }

        $bill->status = 'Cancelled';
        $bill->save();
        
        return response()->json(['success' => 1, 'message' => 'Cancelled!']);
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


}