<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyList;
use App\Models\CompanyBranch;
use App\Models\CompanyBranchLocation;

use App\Models\PurchaseOrder; 

use App\Models\PurchaseBilling; 
use App\Models\PurchaseBillingExpense; 

use App\Models\Payment; 
use App\Models\PaymentBilling; 


use Illuminate\Support\Facades\Auth; 

class BuyAndPayPaymentController extends Controller
{

    public function index()
    {
        $lists = Payment::whereNull('deleted_at')
            ->with('Supplier');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $lists = $lists->where(function($query) use ($keyword) {
                $query->where('transaction_no','LIKE','%'.$keyword.'%');
            });
        }


        if (!empty(request()->supplier)) {
            $lists = $lists->where('supplier_uuid','=',request()->supplier);
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

    
    public function store()
    {
       $formdata = (object) request()->all();
       $bills = (object) $formdata->bills;


        $prefix = $this->getCompanyPrefix();
        $type = 'PE';
        $no_of_transactions = $this->getNumberOfTransactions() + 1;
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $created_id = sprintf($type.'_'.$prefix.''.$year.''.$month.''.$day.'%05d',$no_of_transactions);
        
        $row = 1;
        $errors = [];

        foreach ($bills as $bill) {
            $bl = PurchaseBilling::where('uuid','=',$bill)->first();
            
            if (!$bl) {
                $errors[] = $row;
            }

            $row++;
        }

        if (count($errors) > 0) {
            $message = ($errors > 1)  ? 'ERROR on rows '.implode(',',$errors) : 'ERROR on row '.implode(',',$errors);
            return response()->json(['success' => 0, 'message' => $message], 500);
        }

        $payment = new Payment;
        $payment->transaction_no = $created_id;
        $payment->entry_type = $formdata->entry_type;
        $payment->entity_uuid = $formdata->supplier_uuid;
        $payment->date = date('Y-m-d');
        $payment->pe_mode = $formdata->pe_mode;
        $payment->amount = $formdata->amount;
        $payment->status = 'To Release';
        $payment->check_no = $formdata->check_no;
        $payment->check_date = $formdata->check_date;
        $payment->save();


        foreach ($bills as $bill) {
            $bl = PurchaseBilling::where('uuid','=',$bill)->first();

            $payment_billing = new PaymentBilling;
            $payment_billing->payment_uuid = $payment->uuid;
            $payment_billing->billing_uuid = $bl->uuid;
            $payment_billing->save();

            $bl->status = 'Paid';
            $bl->save();

            if ($bl->transaction_type == 'Inventory') {
                $order = PurchaseOrder::where('billing_no','=',$bl->transaction_no)->first();
                $order->payment_no = $created_id;
                $order->payment_status = 'To Release';
                $order->billing_status = 'Paid';
                $order->save();
            }
        }

        $payment = Payment::find($payment->uuid);
        return response()->json(['success' => 1, 'message' => 'success', 'data' => $payment], 200);

       
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
        $no_of_transactions = Payment::whereNull('deleted_at')
        //->where('company_id',$auth->company_id)
        ->where('transaction_no','!=','')
        ->whereDate('created_at',date('Y-m-d'))->count();

        return $no_of_transactions;
    }

   
}