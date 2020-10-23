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
        $list = ItemList::where('is_draft','=', 0)->whereNull('deleted_at')
        ->with('ItemGroup')->with('Suppliers')
        ->with('IncomeAccount')->with('CosAccount')
        ->with('CatDepartment')
        ->with('CatSection')->with('CatCategory')
        ->with('CatManufacturer')->with('CatItemType')
        ->with('CatBrand')->with('CatForm')
        ->with('CatPackingType')->with('CatSizes')
        ->with('AssetGroup');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('item_code','LIKE','%'.$keyword.'%')
                    ->orWhere('item_barcode','LIKE','%'.$keyword.'%')
                    ->orWhere('item_description','LIKE','%'.$keyword.'%')
                    ->orWhere('item_shortname','LIKE','%'.$keyword.'%');
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

    public function store() // initialize draft
    {
        $item =  ItemList::where('is_draft','=', 1)->first();

        if (!$item) {
            $auth = \Auth::user();

            $item = new ItemList();
            $item->company_id = $auth->company_id;

            $item->save();
        }


        $item = ItemList::find($item->uuid);
        return response()->json(['success' => 1, 'data' => $item], 200);
    }

    public function update()
    {
        $item =  ItemList::find(request()->uuid);
        
        if (!$item) {
            return response()->json(['success' => 0, 'data' => null, 'Item not found'], 500);
        }

        $uoms = request()->item_uoms;
        $existing_barcodes = [];
        //dd($uoms);

        foreach ($uoms as $uom) {
            $barcode = $uom['barcode'];
            $global_uom_uuid = $uom['uom']; // global_uom_uuid
            $exists = ItemUom::where('barcode','=',$barcode)->first();

            if ($exists && $exists->global_uom_uuid != $global_uom_uuid) {
                $existing_barcodes[] = $barcode;
            }
        }


        if (count($existing_barcodes) >= 1) {
            $barcodes = implode(',',$existing_barcodes);
            $message = (count($existing_barcodes) > 1) ? 'The following barcodes '.$barcodes.' already exists!' : 'The barcode "'.$barcodes.'" already exists!';
            return response()->json(['success' => 0, 'message' => $message], 500);
        }
        
        $auth = \Auth::user();
        $item->company_id = $auth->company_id;
        $item->item_group_uuid = request()->item_group_uuid;
        $item->item_code = request()->item_code;
        $item->item_barcode = request()->item_barcode;
        $item->global_base_uom_uuid = request()->global_base_uom_uuid;
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
        $item->without_vat = request()->without_vat;
        $item->is_maintain_stock = request()->is_maintain_stock;
        $item->is_active = request()->is_active;
        $item->coa_income_account_uuid = request()->coa_income_account_uuid;
        $item->coa_cos_account_uuid = request()->coa_cos_account_uuid;
        $item->reorder_qty = request()->reorder_qty;
        $item->item_asset_group_uuid = request()->item_asset_group_uuid;
        $item->cat_department_uuid = request()->cat_department_uuid;
        $item->cat_section_uuid = request()->cat_section_uuid;
        $item->cat_category_uuid = request()->cat_category_uuid;
        $item->cat_manufacturer_uuid = request()->cat_manufacturer_uuid;
        $item->cat_item_type_uuid = request()->cat_item_type_uuid;
        $item->cat_brand_uuid = request()->cat_brand_uuid;
        $item->cat_form_uuid = request()->cat_form_uuid;
        $item->cat_packing_type_uuid = request()->cat_packing_type_uuid;
        $item->cat_sizes_uuid = request()->cat_sizes_uuid;
        $item->is_draft = 0;
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

       
        // mark all current item uom as deleted
        $item_uom = ItemUom::where('item_uuid','=',$item->uuid)->delete();

        foreach ($uoms as $uom) {

            $packing = $uom['packing'];
            $global_uom_uuid = $uom['uuid'];
            $barcode = $uom['barcode'];
            $sales_description = $uom['sales_description'];
            $remarks = $uom['remarks'];

            if (!is_numeric($packing) || $packing < 1) {
                continue;
            }
            
            // check if valid UOM (meaning the uuid exist on global)
            $exist = GlobalUom::find($global_uom_uuid);

            if (!$exist ) {
                continue;
            }
            
            $item_uom = ItemUom::where('item_uuid','=',$item->uuid)->where('global_uom_uuid','=',$global_uom_uuid)->where('barcode','=',$barcode)->withTrashed()->first();
            $item_uom = ($item_uom) ? $item_uom :  new ItemUom;

            $item_uom->company_id = $auth->company_id;
            $item_uom->item_uuid = $item->uuid;
            $item_uom->global_uom_uuid = $global_uom_uuid;
            $item_uom->packing_qtty = $packing;
            $item_uom->barcode = $barcode;
            $item_uom->sales_description =  $sales_description;
            $item_uom->remarks =  $remarks;

            $item_uom->deleted_at = null;
            $item_uom->save();
            
        }
        $item = ItemList::find($item->uuid);
        return response()->json(['success' => 1, 'rows' => $item], 200);
    }

    public function show($itemUUID) // set update records
    {
        $item = ItemList::with('ItemGroup')->with('Suppliers')
        ->with('IncomeAccount')->with('CosAccount')
        ->with('CatDepartment')
        ->with('CatSection')->with('CatCategory')
        ->with('CatManufacturer')->with('CatItemType')
        ->with('CatBrand')->with('CatForm')
        ->with('CatPackingType')->with('CatSizes')
        ->with('AssetGroup')->find($itemUUID);

        if (!$item) {
            return response()->json(['success' => 0, 'data' => null, 'Item not found'], 500);
        }
        return response()->json(['success' => 1, 'data' => $item], 200);
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