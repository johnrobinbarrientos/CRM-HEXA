<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\PriceRuleCustomer; 
use Illuminate\Support\Facades\Auth; 

class PriceRuleCustomerController extends Controller
{
    public function getPriceRuleCustomer()
    {
        $customerRule = PriceRuleCustomer::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $customerRule], 200);
    }

    public function save()
    {
        $customerRule = request()->uuid ? PriceRuleCustomer::find(request()->uuid) : new PriceRuleCustomer();

        $customerRule->rule_name = request()->rule_name;
        $customerRule->rate = request()->rate;
        $customerRule->date_start = request()->date_start;
        $customerRule->date_end = request()->date_end;
        $customerRule->mechanics = request()->mechanics;
        $customerRule->target_amount = request()->target_amount;
        $customerRule->save();

        $customerRule = PriceRuleCustomer::find($customerRule->uuid);

        return response()->json(['success' => 1, 'rows' => $customerRule], 200);
    }


    public function delete()
    {
        $customerRule = PriceRuleCustomer::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}