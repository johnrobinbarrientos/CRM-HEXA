<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\BuyAndPayOrderReasonCodes; 
use Illuminate\Support\Facades\Auth; 

class BuyAndPayOrderReasonCodesController extends Controller
{
    public function getReasonCode()
    {
        $reasonCode = BuyAndPayOrderReasonCodes::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $reasonCode], 200);
    }

    public function saveReasonCode()
    {
        $reasonCode = request()->uuid ? BuyAndPayOrderReasonCodes::find(request()->uuid) : new BuyAndPayOrderReasonCodes();
        $auth = \Auth::user();
        $reasonCode->company_id = $auth->company_id;
        $reasonCode->reason_code = request()->reason_code;
        $reasonCode->save();

        $reasonCode = BuyAndPayOrderReasonCodes::find($reasonCode->uuid);

        return response()->json(['success' => 1, 'rows' => $reasonCode], 200);
    }

    public function deleteReasonCode()
    {
        $reasonCode = BuyAndPayOrderReasonCodes::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}