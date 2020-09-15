<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\PriceRuleCustomerItem; 
use Illuminate\Support\Facades\Auth; 

class PriceRuleCustomerItemController extends Controller
{
    public function getCustomerItem()
    {
        $customerItem = PriceRuleCustomerItem::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $customerItem], 200);
    }

    public function save()
    {
        $customerItem = request()->uuid ? PriceRuleCustomerItem::find(request()->uuid) : new PriceRuleCustomerItem();
        $auth = \Auth::user();
        $customerItem->company_id = $auth->company_id;
        $customerItem->price_rule_customer_uuid = request()->price_rule_customer_uuid;
        $customerItem->item_uuid = request()->item_uuid;
        $customerItem->save();

        $customerItem = PriceRuleCustomerItem::find($customerItem->uuid);

        return response()->json(['success' => 1, 'rows' => $customerItem], 200);
    }


    public function delete()
    {
        $customerItem = PriceRuleCustomerItem::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}