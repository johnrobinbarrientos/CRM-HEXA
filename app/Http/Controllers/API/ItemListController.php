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

use  App\Http\Controllers\API\ItemSupplierController;
use  App\Http\Controllers\API\ItemUOMController;

class ItemListController extends Controller
{
    public function index()
    {
        $list = ItemList::where('is_draft','=', 0)->whereNull('deleted_at')
        ->with('ItemGroup')->with('Suppliers')
        ->with('IncomeAccount')->with('CosAccount')
        ->with('CatDepartment')
        ->with('CatSection')->with('CatCategory')
        ->with('CatManufacturer')->with('CatItemType')
        ->with('CatBrand')->with('CatForm')
        ->with('CatPackingType')->with('AssetGroup');

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
        
        return response()->json(['success' => 1, 'rows' => $list, 'count' => $count, 'offset' => $offset, 'results' => count($list)], 200);
    }

    public function store()
    {
        return $this->save();
    }

    public function update($uuid) 
    {
        return $this->save($uuid);
    }

    public function save($uuid = '')
    {

        $suppliers = (isset(request()->suppliers)) ? request()->suppliers : [];
        $check = ItemSupplierController::check($suppliers);

        if ($check['errors'] > 0) {
           return response()->json(['success' => 0, 'suppliers' => $check['suppliers'], 'errors' => $check['errors'], 'tab' => 'pricing' ], 500);
        }


        $uoms = (isset(request()->uoms)) ? request()->uoms : [];
        $check = ItemUOMController::check($uoms);

        if ($check['errors'] > 0) {
           return response()->json(['success' => 0, 'uoms' => $check['uoms'], 'errors' => $check['errors'], 'tab' => 'uoms' ], 500);
        }

        $item =  ItemList::find($uuid);
        $item = ($item) ? $item : new SupplierList();
        
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
        $item->vat_uuid = (request()->is_vat) ? request()->vat_uuid : null;
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
        $item->cat_size = request()->cat_size;
        $item->is_draft = 0;
        $item->save();
        

        $item = ItemList::find($item->uuid);
        $suppliers_save = ItemSupplierController::save($item->uuid,$suppliers);
        $uoms_save = ItemUOMController::save($item->uuid,$uoms);

        return response()->json(['success' => 1, 'rows' => $item], 200);
    }

    public function show($itemUUID) // set update records
    {
        $item = ItemList::with('ItemGroup')
        ->with('Suppliers')
        ->with('IncomeAccount')
        ->with('CosAccount')
        ->with('CatDepartment')
        ->with('CatSection')
        ->with('CatCategory')
        ->with('CatManufacturer')
        ->with('CatItemType')
        ->with('CatBrand')
        ->with('CatForm')
        ->with('CatPackingType')
        ->with('AssetGroup')
        ->find($itemUUID);

        if (!$item) {
            return response()->json(['success' => 0, 'data' => null, 'Item not found'], 500);
        }
        return response()->json(['success' => 1, 'data' => $item], 200);
    }

    public function delete($item_uuid)
    {
        $item = ItemList::find($item_uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }

    public function uoms($itemUUID)
    {
        $uoms = ItemUom::with('Item')->with('GlobalUom')->where('item_uuid','=',$itemUUID)->orderBy('packing_qtty')->get();

        return response()->json(['success' => 1, 'rows' => $uoms], 200);
    }
}