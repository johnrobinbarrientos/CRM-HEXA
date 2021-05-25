<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemList; 
use App\Models\ItemSupplier; 
use App\Models\ItemUom; 
use App\Models\BDGroupSupplier; 
use Illuminate\Support\Facades\Auth; 

class ItemUOMController extends Controller
{
    public static function check($uoms)
    {
        $errors = 0;
        foreach ($uoms as $key => $uom) {

            $uom['barcode_error'] = false;
            $uom['packing_qtty_error'] = false;
            $uom['sales_description_error'] = false;

            if (empty($uom['barcode'])) {
                $uom['barcode_error'] = true;
                $errors++;
            }

            if (empty($uom['packing_qtty'])) {
                $uom['packing_qtty_error'] = true;
                $errors++;
            }

            if (empty($uom['sales_description'])) {
                $uom['sales_description_error'] = true;
                $errors++;
            }

            $barcode = $uom['barcode'];
            $global_uom_uuid = $uom['global_uom_uuid']; // global_uom_uuid
            $exists = ItemUom::where('barcode','=',$barcode)->first();

            if ($exists && $exists->global_uom_uuid != $global_uom_uuid) {
                $uom['barcode_error'] = true;
                $errors++;
            }

            $uoms[$key] = $uom;
        }

        return ['uoms' => $uoms, 'errors' => $errors];
    }

    public static function save($item_uuid, $uoms)
    {
        foreach ($uoms as $key => $uom) {

            $global_uom_uuid = $uom['global_uom_uuid']; // global_uom_uuid
            $barcode = $uom['barcode'];
            $packing_qtty = $uom['packing_qtty'];
            $sales_description = $uom['sales_description'];
            $remarks = $uom['remarks'];
            

            $item_uom = ItemUom::where('item_uuid','=',$item_uuid)->where('global_uom_uuid','=',$global_uom_uuid)->where('barcode','=',$barcode)->withTrashed()->first();
            $item_uom = ($item_uom) ? $item_uom :  new ItemUom;

            $item_uom->item_uuid = $item_uuid;
            $item_uom->global_uom_uuid = $global_uom_uuid;
            $item_uom->packing_qtty = $packing_qtty;
            $item_uom->barcode = $barcode;
            $item_uom->sales_description =  $sales_description;
            $item_uom->remarks =  $remarks;
            $item_uom->deleted_at = null;
            $item_uom->save();
        }
    }
}