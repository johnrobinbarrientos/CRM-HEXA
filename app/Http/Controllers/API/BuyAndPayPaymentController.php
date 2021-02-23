<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyList;
use App\Models\CompanyBranch;
use App\Models\CompanyBranchLocation;

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

    
    public function store()
    {
       
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