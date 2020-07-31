<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemList; 
use Illuminate\Support\Facades\Auth; 

class ItemListController extends Controller
{
    public function getAllItem()
    {
        $list = ItemList::whereNull('deleted_at')
        ->with('ItemGroup')->with('Supplier')
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
        $item = new ItemList();
        $auth = \Auth::user();
        $item->company_id = $auth->company_id;
        
        $item->item_group_uuid = request()->item_group_uuid;
        $item->item_code = request()->item_code;
        $item->item_barcode = request()->item_barcode;
        $item->cs_barcode = request()->cs_barcode;
        $item->item_description = request()->item_description;
        $item->item_shortname = request()->item_shortname;
        $item->supplier_uuid = request()->supplier_uuid;
        $item->is_purchase_item = request()->is_purchase_item;
        $item->purchase_uom = request()->purchase_uom;
        $item->purchase_cost = request()->purchase_cost;
        $item->is_sales_item = request()->is_sales_item;
        $item->sales_uom = request()->sales_uom;
        $item->sales_cost = request()->sales_cost;
        $item->transfer_cost = request()->transfer_cost;
        $item->is_expiry = request()->is_expiry;
        $item->vat_uuid = request()->vat_uuid;
        $item->coa_income_account_uuid = request()->coa_income_account_uuid;
        $item->coa_cos_account_uuid = request()->coa_cos_account_uuid;
        $item->reorder_qty = request()->reorder_qty;
        $item->item_asset_group_uuid = request()->item_asset_group_uuid;
        $item->mv_registration_no = request()->mv_registration_no;
        $item->plate_no = request()->plate_no;
        $item->category1_uuid = request()->category1_uuid;
        $item->category2_uuid = request()->category2_uuid;
        $item->category3_uuid = request()->category3_uuid;
        $item->category4_uuid = request()->category4_uuid;
        $item->category5_uuid = request()->category5_uuid;
        $item->save();

        $item = ItemList::find($item->uuid);
        return response()->json(['success' => 1, 'data' => $item, 'message' => 'Item Added!'], 200); 
    }


    public function update()
    {
        $item = ItemList::find(request()->uuid);

        if (!$item) {
            return response()->json(['success' => 0, 'message' => 'Could not find Item!'], 200);
        }

        $item->item_group_uuid = request()->item_group_uuid;
        $item->item_code = request()->item_code;
        $item->item_barcode = request()->item_barcode;
        $item->cs_barcode = request()->cs_barcode;
        $item->item_description = request()->item_description;
        $item->item_shortname = request()->item_shortname;
        $item->supplier_uuid = request()->supplier_uuid;
        $item->is_purchase_item = request()->is_purchase_item;
        $item->purchase_uom = request()->purchase_uom;
        $item->purchase_cost = request()->purchase_cost;
        $item->is_sales_item = request()->is_sales_item;
        $item->sales_uom = request()->sales_uom;
        $item->sales_cost = request()->sales_cost;
        $item->transfer_cost = request()->transfer_cost;
        $item->is_expiry = request()->is_expiry;
        $item->vat_uuid = request()->vat_uuid;
        $item->coa_income_account_uuid = request()->coa_income_account_uuid;
        $item->coa_cos_account_uuid = request()->coa_cos_account_uuid;
        $item->reorder_qty = request()->reorder_qty;
        $item->item_asset_group_uuid = request()->item_asset_group_uuid;
        $item->mv_registration_no = request()->mv_registration_no;
        $item->plate_no = request()->plate_no;
        $item->category1_uuid = request()->category1_uuid;
        $item->category2_uuid = request()->category2_uuid;
        $item->category3_uuid = request()->category3_uuid;
        $item->category4_uuid = request()->category4_uuid;
        $item->category5_uuid = request()->category5_uuid;
        $item->save();
        
        return response()->json(['success' => 1, 'data' => $item, 'message' => 'Item Updated!'], 200); 
    }

    public function delete()
    {
        $item = ItemList::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Item Deleted!'], 200);
    }
}