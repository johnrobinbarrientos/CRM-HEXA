<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\PurchaseOrderReasonCode; 
use Illuminate\Support\Facades\Auth; 

class PurchaseOrderReasonCodeController extends Controller
{
    public function getReasonCode()
    {
        $list = PurchaseOrderReasonCode::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('short_name','LIKE','%'.$keyword.'%')
                ->orWhere('details','LIKE','%'.$keyword.'%');
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
        $reasonCode = request()->uuid ? PurchaseOrderReasonCode::find(request()->uuid) : new PurchaseOrderReasonCode();
        $auth = \Auth::user();
        $reasonCode->company_id = $auth->company_id;
        $reasonCode->short_name = strtoupper(request()->short_name);
        $reasonCode->details = request()->details;
        $reasonCode->save();

        $reasonCode = PurchaseOrderReasonCode::find($reasonCode->uuid);

        return response()->json(['success' => 1, 'rows' => $reasonCode], 200);
    }

    public function deleteReasonCode()
    {
        $reasonCode = PurchaseOrderReasonCode::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}