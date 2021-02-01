<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\PriceRuleCustomerDetail; 
use Illuminate\Support\Facades\Auth; 

class PriceRuleCustomerDetailController extends Controller
{
    public function getCustomerDetail()
    {
        $detailRule = PriceRuleCustomerDetail::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $detailRule], 200);
    }

    public function save()
    {
        $detailRule = request()->uuid ? PriceRuleCustomerDetail::find(request()->uuid) : new PriceRuleCustomerDetail();

        $detailRule->price_rule_customer_uuid = request()->price_rule_customer_uuid;
        $detailRule->customer_uuid = request()->customer_uuid;
        $detailRule->applied_to = request()->applied_to;
        $detailRule->save();

        $detailRule = PriceRuleCustomerDetail::find($detailRule->uuid);

        return response()->json(['success' => 1, 'rows' => $detailRule], 200);
    }


    public function delete()
    {
        $detailRule = PriceRuleCustomerDetail::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}