<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\AdminUom; 
use Illuminate\Support\Facades\Auth; 

class AdminUomController extends Controller
{
    public function getUoms()
    {
        $Uoms = AdminUom::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $Uoms], 200);
    }

    public function save()
    {
        $Uoms = request()->uuid ? AdminUom::find(request()->uuid) : new AdminUom();
        $Uoms->uom = request()->uom;
        $Uoms->type = request()->type;
        $Uoms->save();

        $Uoms = AdminUom::find($Uoms->uuid);

        return response()->json(['success' => 1, 'rows' => $Uoms], 200);
    }

    public function delete()
    {
        $Uoms = AdminUom::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}