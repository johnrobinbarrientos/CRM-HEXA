<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ReasonCode; 
use Illuminate\Support\Facades\Auth; 

class ReasonCodeController extends Controller
{
    public function index()
    {
        $type = request()->type;

        $list = ReasonCode::whereNull('deleted_at');

        if ($type == 'purchase-order') {
            $list->where(function ($query) {
                $query->where('type','Purchase Order');
            });
        } else if ($type == 'billing') {
            $list->where(function ($query) {
                $query->where('type','Billing');
            });
        } else if ($type == 'debit-memo') {
            $list->where(function ($query) {
                $query->where('type','Debit Memo');
            });
        } else if ($type == 'sales-order') {
            $list->where(function ($query) {
                $query->where('type','Sales Order');
            });
        } else if ($type == 'invoicing') {
            $list->where(function ($query) {
                $query->where('type','Invoicing');
            });
        }
        else if ($type == 'credit-memo') {
            $list->where(function ($query) {
                $query->where('type','Credit Memo');
            });
        }
        
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

    public function store()
    {
        $reasonCode = new ReasonCode();

        $reasonCode->short_name = strtoupper(request()->short_name);
        $reasonCode->details = request()->details;
        $reasonCode->type = request()->type;
        $reasonCode->save();

        $reasonCode = ReasonCode::find($reasonCode->uuid);

        return response()->json(['success' => 1, 'rows' => $reasonCode], 200);
    }

    public function update()
    {
        $reasonCode =  ReasonCode::find(request()->uuid);
        
        if (!$reasonCode) {
            return response()->json(['success' => 0, 'data' => null, 'Not found'], 500);
        }

        $reasonCode->short_name = strtoupper(request()->short_name);
        $reasonCode->details = request()->details;
        $reasonCode->type = request()->type;
        $reasonCode->save();

        $reasonCode = ReasonCode::find($reasonCode->uuid);

        return response()->json(['success' => 1, 'rows' => $reasonCode], 200);
    }

    public function delete($reason_code_uuid)
    {
        $reasonCode = ReasonCode::find($reason_code_uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}