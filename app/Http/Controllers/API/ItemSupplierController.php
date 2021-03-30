<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemList; 
use App\Models\ItemSupplier; 
use App\Models\BDSupplier; 
use Illuminate\Support\Facades\Auth; 

class ItemSupplierController extends Controller
{
    public static function check($suppliers)
    {
        $errors = 0;
        foreach ($suppliers as $key => $supplier) {

            $supplier['purchase_price_error'] = false;
            $supplier['bd_supplier_uuid_error'] = false;

            if (empty($supplier['purchase_price'])) {
                $supplier['purchase_price_error'] = true;
                $errors++;
            }

            if (!empty($supplier['bd_supplier_uuid']) || !is_null($supplier['bd_supplier_uuid'])) {

                $exists = BDSupplier::where('uuid','=',$supplier['bd_supplier_uuid'])
                    ->where('supplier_uuid','=',$supplier['uuid'])
                    ->first();

                if (!$exists) {
                    $supplier['bd_supplier_uuid_error'] = true;
                    $errors++;
                }
            }

            $suppliers[$key] = $supplier;
        }

        return ['suppliers' => $suppliers, 'errors' => $errors];
    }

    public static function save($item_uuid, $suppliers)
    {
        foreach ($suppliers as $key => $supplier) {
            $supplier_uuid = $supplier['uuid'];
            $price = $supplier['purchase_price'];
            $bd_supplier_uuid = $supplier['bd_supplier_uuid'];

            $item_supplier = ItemSupplier::where('item_uuid','=',$item_uuid)->where('supplier_uuid','=',$supplier_uuid)->withTrashed()->first(); 
            
            $item_supplier = ($item_supplier) ? $item_supplier : new ItemSupplier();
            $item_supplier->item_uuid = $item_uuid;
            $item_supplier->supplier_uuid = $supplier_uuid;
            $item_supplier->purchase_price = $price;
            $item_supplier->bd_supplier_uuid = $bd_supplier_uuid;
            $item_supplier->deleted_at = null;
            $item_supplier->save();

        }
    }
}