<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemList;
use App\Models\ItemSupplier;
use App\Models\ItemUom; 
use App\Models\GlobalUom; 
use App\Models\SupplierList; 
use Illuminate\Support\Facades\Auth; 

class ItemListController extends Controller
{
    public function getItemList()
    {
        $list = ItemList::whereNull('deleted_at')
        ->with('ItemGroup')->with('Suppliers')
        ->with('IncomeAccount')->with('CosAccount')
        ->with('Tax')->with('Category1')
        ->with('Category2')->with('Category3')
        ->with('Category4')->with('Category5')
        ->with('AssetGroup')
        ->get();
        return response()->json(['success' => 1, 'rows' => $list], 200);
    }

    public function save()
    {
        $item = request()->uuid ? ItemList::find(request()->uuid) : new ItemList();
        $auth = \Auth::user();
        $item->company_id = $auth->company_id;
        $item->item_group_uuid = request()->item_group_uuid;
        $item->item_code = request()->item_code;
        $item->item_barcode = request()->item_barcode;
        $item->cs_barcode = request()->cs_barcode;
        $item->item_description = request()->item_description;
        $item->item_shortname = request()->item_shortname;
        $item->is_purchase_item = request()->is_purchase_item;
        $item->purchase_price = request()->purchase_price;
        $item->is_sales_item = request()->is_sales_item;
        $item->sales_price = request()->sales_price;
        $item->manual_rate = request()->manual_rate;
        $item->customer_group_uuid = request()->customer_group_uuid;
        $item->option_rate = request()->option_rate;
        $item->is_expiry = request()->is_expiry;
        $item->vat_uuid = request()->vat_uuid;
        $item->is_maintain_stock = request()->is_maintain_stock;
        $item->is_active = request()->is_active;
        $item->coa_income_account_uuid = request()->coa_income_account_uuid;
        $item->coa_cos_account_uuid = request()->coa_cos_account_uuid;
        $item->reorder_qty = request()->reorder_qty;
        $item->item_asset_group_uuid = request()->item_asset_group_uuid;
        $item->item_discount_group_uuid = request()->item_discount_group_uuid;
        $item->category1_uuid = request()->category1_uuid;
        $item->category2_uuid = request()->category2_uuid;
        $item->category3_uuid = request()->category3_uuid;
        $item->category4_uuid = request()->category4_uuid;
        $item->category5_uuid = request()->category5_uuid;
        $item->save();
        

        $supplier_uuids = request()->supplier_uuids;
        $item_suppliers = ItemSupplier::where('item_uuid', '=', $item->uuid)->delete();
        foreach ($supplier_uuids as $supplier_uuid) {
            
            // make sure the suppier belongs to the company
            $exists = SupplierList::where('uuid','=',$supplier_uuid)->where('company_id','=',$auth->company_id)->first();
            
            if (!$exists) {
                continue;
            }

            $item_supplier = ItemSupplier::where('item_uuid','=',$item->uuid)->where('supplier_uuid','=',$supplier_uuid)->withTrashed()->first();
            $item_supplier = (!$item_supplier) ? new ItemSupplier : $item_supplier;
            $item_supplier->item_uuid = $item->uuid;
            $item_supplier->supplier_uuid = $supplier_uuid;
            $item_supplier->deleted_at = null;
            $item_supplier->save();
        }

        $uoms = request()->item_uoms;
        // mark all current item uom as deleted
        $item_uom = ItemUom::where('item_uuid','=',$item->uuid)->delete();

        foreach ($uoms as $uom) {

            $packing = $uom['packing'];
            $global_uom_uuid = $uom['uuid'];

            if (!is_numeric($packing) || $packing < 1) {
                continue;
            }
            
            // check if valid UOM (meaning the uuid exist on global)
            $exist = GlobalUom::find($global_uom_uuid);

            if (!$exist ) {
                continue;
            }
            
            $item_uom = ItemUom::where('item_uuid','=',$item->uuid)->where('global_uom_uuid','=',$global_uom_uuid)->withTrashed()->first();
            $item_uom = ($item_uom) ? $item_uom :  new ItemUom;

            $item_uom->item_uuid = $item->uuid;
            $item_uom->global_uom_uuid = $global_uom_uuid;
            $item_uom->packing_qtty = $packing;

            $item_uom->deleted_at = null;
            $item_uom->save();
            
        }
        $item = ItemList::find($item->uuid);
        return response()->json(['success' => 1, 'data' => $item, 'message' => 'Item Added!'], 200); 
    }

    public function delete($itemUUID)
    {
        $item = ItemList::find($itemUUID)->delete();
        return response()->json(['success' => 1, 'message' => 'Item Deleted!'], 200);
    }

    public function uoms($itemUUID)
    {
        $uoms = ItemUom::with('Item')->with('GlobalUom')->where('item_uuid','=',$itemUUID)->orderBy('packing_qtty')->get();

        return response()->json(['success' => 1, 'rows' => $uoms], 200);
    }
}