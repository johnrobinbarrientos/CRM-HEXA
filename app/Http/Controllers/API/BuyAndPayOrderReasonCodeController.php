<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\BuyAndPayOrderReasonCode; 
use Illuminate\Support\Facades\Auth; 

class BuyAndPayOrderReasonCodeController extends Controller
{
    public function getReasonCode()
    {
        $list = BuyAndPayOrderReasonCode::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('reason_code','LIKE','%'.$keyword.'%');
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

        return response()->json(['success' => 1, 'rows' => $list, 'count' => $count], 200);
    }

    public function saveReasonCode()
    {
        $reasonCode = request()->uuid ? BuyAndPayOrderReasonCode::find(request()->uuid) : new BuyAndPayOrderReasonCode();
        $auth = \Auth::user();
        $reasonCode->company_id = $auth->company_id;
        $reasonCode->reason_code = request()->reason_code;
        $reasonCode->save();

        $reasonCode = BuyAndPayOrderReasonCode::find($reasonCode->uuid);

        return response()->json(['success' => 1, 'rows' => $reasonCode], 200);
    }

    public function deleteReasonCode()
    {
        $reasonCode = BuyAndPayOrderReasonCode::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}