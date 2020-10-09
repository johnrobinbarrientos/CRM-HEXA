<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\GlobalUom; 
use Illuminate\Support\Facades\Auth; 

class GlobalUomController extends Controller
{
    public function getUoms()
    {
        $list = GlobalUom::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('uom','LIKE','%'.$keyword.'%');
            });
        }

        $count = $list->count();

        // pagination
        $take = (is_numeric(request()->take) && request()->take <= 50) ? request()->take: 20;
        $page = (is_numeric(request()->page)) ? request()->page : 1;
        $offset = (($page - 1 ) * $take);

        $list = $list->take($take);
        $list = $list->offset($offset);
        $list = $list->get();

        return response()->json(['success' => 1, 'rows' => $list, 'count' => $count], 200);
    }

    public function getBaseUom()
    {
        $Uoms = GlobalUom::whereNull('deleted_at')->where('type','Base')->get();
        return response()->json(['success' => 1, 'rows' => $Uoms], 200);
    }

    public function getPackingUom()
    {
        $Uoms = GlobalUom::whereNull('deleted_at')->where('type','Pack')->get();
        return response()->json(['success' => 1, 'rows' => $Uoms], 200);
    }

    public function save()
    {
        $Uoms = request()->uuid ? GlobalUom::find(request()->uuid) : new GlobalUom();
        $Uoms->uom = request()->uom;
        $Uoms->type = request()->type;
        $Uoms->save();

        $Uoms = GlobalUom::find($Uoms->uuid);

        return response()->json(['success' => 1, 'rows' => $Uoms], 200);
    }

    public function delete()
    {
        $Uoms = GlobalUom::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}