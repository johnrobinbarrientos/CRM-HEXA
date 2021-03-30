<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\PriceRule; 
use App\Models\PriceRuleItem; 
use App\Models\PriceRuleCustomer; 
use Illuminate\Support\Facades\Auth; 

class PriceRuleController extends Controller
{
    public function index()
    {
        // $priceRules = PriceRule::where('is_draft','=', 0)->whereNull('deleted_at')->get();
        // return response()->json(['success' => 1, 'rows' => $priceRules], 200);
        $list = PriceRule::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('name','LIKE','%'.$keyword.'%');
            });
        }

        $count = $list->count();

        // pagination
        $take = (is_numeric(request()->take) && request()->take <= 100) ? request()->take: 20;
        $page = (is_numeric(request()->page)) ? request()->page : 1;
        $offset = (($page - 1 ) * $take);

        $list = $list->take($take);
        $list = $list->offset($offset);
        $list = $list->get();

        return response()->json(['success' => 1, 'rows' => $list, 'count' => $count, 'offset' => $offset, 'results' => count($list)], 200);
    }

    public function show($uuid)
    {
        $price_rule = PriceRule::find($uuid);
        $price_rule->items = PriceRuleItem::where('price_rule_uuid','=',$price_rule->uuid)->pluck('item_uuid')->toArray();
        
        if($price_rule->applicable_to == 'Selling') {
            $price_rule->customers = PriceRuleCustomer::where('price_rule_uuid','=',$price_rule->uuid)->pluck('customer_uuid')->toArray();
        }
    
        return response()->json(['success' => 1, 'data' => $price_rule], 200);
    }



    public function store()
    {
        return $this->save();
    }

    public function update($uuid) 
    {
        return $this->save($uuid);
    }
    
    public function save($uuid = '')
    {
        $items = request()->selected_items;
        $customers = request()->selected_customers;
        $supplier_uuid = (request()->applicable_to == 'Buying') ? request()->supplier_uuid : null;

        // add validation if supplier exists
        // add item validation here e.g if item exist and item truly belongs to the supplier (IF Buying)
        // add item validation here e.g if item exist and item is_sales_item (IF Selling)

        $price_rule =  PriceRule::find($uuid);
        $price_rule = ($price_rule) ? $price_rule : new PriceRule();

        if ($uuid == '') {
            $price_rule->applicable_to      = request()->applicable_to;
            $price_rule->supplier_uuid      = $supplier_uuid;
        }

        $price_rule->name               = request()->name;
        $price_rule->rate               = request()->rate;
        $price_rule->date_start         = request()->date_start;
        $price_rule->date_end           = request()->date_end;
        $price_rule->mechanics          = request()->mechanics;
        $price_rule->save();

        $price_rule = PriceRule::where('uuid','=',$price_rule->uuid)->first();

        $this->saveItems($price_rule->uuid,$items);

        if ($price_rule->applicable_to == 'Selling')  {
            $this->saveCustomers($price_rule->uuid,$customers);
        }

        return response()->json(['success' => 1], 200);
    }

    public function saveItems($price_rule_uuid,$items)
    {
        PriceRuleItem::where('price_rule_uuid','=',$price_rule_uuid)->delete();

        foreach ($items as $item) {
            $price_rule_item = PriceRuleItem::where('price_rule_uuid','=',$price_rule_uuid)->where('item_uuid','=',$item)->withTrashed()->first();
            $price_rule_item = ($price_rule_item) ? $price_rule_item : new PriceRuleItem();
            $price_rule_item->price_rule_uuid = $price_rule_uuid;
            $price_rule_item->item_uuid = $item;
            $price_rule_item->deleted_at = null;
            $price_rule_item->save();
        }
    }

    public function saveCustomers($price_rule_uuid,$customers)
    {
        PriceRuleCustomer::where('price_rule_uuid','=',$price_rule_uuid)->delete();

        foreach ($customers as $customer) {
            $price_rule_customer = PriceRuleCustomer::where('price_rule_uuid','=',$price_rule_uuid)->where('customer_uuid','=',$customer)->withTrashed()->first();
            $price_rule_customer = ($price_rule_customer) ? $price_rule_customer : new PriceRuleCustomer();
            $price_rule_customer->price_rule_uuid = $price_rule_uuid;
            $price_rule_customer->customer_uuid = $customer;
            $price_rule_customer->deleted_at = null;
            $price_rule_customer->save();
        }
    }

    public function delete()
    {
        $priceRule = PriceRule::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}