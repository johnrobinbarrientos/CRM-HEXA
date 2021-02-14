<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\PriceRule; 
use Illuminate\Support\Facades\Auth; 

class PriceRuleController extends Controller
{
    public function index()
    {
        // $priceRules = PriceRule::where('is_draft','=', 0)->whereNull('deleted_at')->get();
        // return response()->json(['success' => 1, 'rows' => $priceRules], 200);

        $list = PriceRule::where('is_draft','=', 0)->whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('rule_name','LIKE','%'.$keyword.'%');
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

    public function update()
    {
        $priceRule =  PriceRule::find(request()->uuid);
        
        if (!$priceRule) {
            return response()->json(['success' => 0, 'data' => null, 'Not found'], 500);
        }

        $priceRule->rule_name = request()->rule_name;
        $priceRule->rate = request()->rate;
        $priceRule->date_start = request()->date_start;
        $priceRule->date_end = request()->date_end;
        $priceRule->mechanics = request()->mechanics;
        $priceRule->applicable_to = request()->applicable_to;
        $priceRule->save();

        $priceRule = PriceRule::find($priceRule->uuid);
        

        return response()->json(['success' => 1, 'rows' => $priceRule], 200);
    }

    public function store() // initialize draft
    {
        $priceRule =  PriceRule::where('is_draft','=', 1)->first();
        if (!$priceRule) {
            
            $priceRule = new PriceRule();
            $priceRule->applicable_to = 'Buying';
            $priceRule->applied_on = 'Group';
            $priceRule->save();
        }

        $priceRule = PriceRule::find($priceRule->uuid);
        return response()->json(['success' => 1, 'data' => $priceRule], 200);
    }

    public function show($uuid)
    {
        $priceRule = PriceRule::find($uuid);
        return response()->json(['success' => 1, 'data' => $priceRule], 200);
    }


    public function delete()
    {
        $priceRule = PriceRule::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}