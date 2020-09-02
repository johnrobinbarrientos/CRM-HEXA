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
        $Uoms = GlobalUom::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $Uoms], 200);
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