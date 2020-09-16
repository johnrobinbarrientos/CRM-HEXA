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
        $reasonCode = BuyAndPayOrderReasonCode::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $reasonCode], 200);
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