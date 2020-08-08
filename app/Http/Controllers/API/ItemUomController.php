<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemUom; 
use Illuminate\Support\Facades\Auth;
 

class ItemUomController extends Controller
{

    public function getUom($uuid)
    {
        // var_dump(request()->uuid);
        // die();
        $uom = ItemUom::whereNull('deleted_at')->where('item_uuid', $uuid)->get();
        return response()->json(['success' => 1, 'rows' => $uom], 200);
    }

    public function save()
    {
        $uom = new ItemUom();
        $auth = \Auth::user();
        $uom->company_id = $auth->company_id;
        $uom->item_uuid = request()->item_uuid;
        $uom->uom = request()->uom;
        $uom->conversion = request()->conversion;
        $uom->save();


        $uom = ItemUom::find($uom->uuid);
        
        return response()->json(['success' => 1, 'data' => $uom, 'message' => 'UOM Updated!'], 200); 
    }

    public function update()
    {
        $uom = ItemUom::find(request()->uuid);

        if (!$uom) {
            return response()->json(['success' => 0, 'message' => 'Could not find UOM!'], 200);
        }

        $uom->uom = request()->uom;
        $uom->conversion = request()->conversion;
        $uom->save();
        
        return response()->json(['success' => 1, 'data' => $uom, 'message' => 'UOM Updated!'], 200); 
    }

    public function delete()
    {
        $uom = ItemUom::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'UOM Deleted!'], 200);
    }
}