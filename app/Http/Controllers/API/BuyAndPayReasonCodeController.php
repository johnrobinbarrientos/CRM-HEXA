<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\PurchaseOrderReasonCode; 
use Illuminate\Support\Facades\Auth; 

class BuyAndPayReasonCodeController extends Controller
{
    public function index()
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

        return response()->json(['success' => 1, 'rows' => $list, 'count' => $count, 'offset' => $offset, 'results' => count($list)], 200);
    }

    public function save()
    {
        $reasonCode = request()->uuid ? PurchaseOrderReasonCode::find(request()->uuid) : new PurchaseOrderReasonCode();

        $reasonCode->short_name = strtoupper(request()->short_name);
        $reasonCode->details = request()->details;
        $reasonCode->save();

        $reasonCode = PurchaseOrderReasonCode::find($reasonCode->uuid);

        return response()->json(['success' => 1, 'rows' => $reasonCode], 200);
    }

    public function delete($uuid)
    {
        $reasonCode = PurchaseOrderReasonCode::find($uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}