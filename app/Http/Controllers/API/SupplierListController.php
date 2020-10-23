<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierList; 
use App\Models\SupplierDiscountRegular; 
use App\Models\ItemList; 
use App\Models\ItemSupplier; 
use App\Models\ItemUom; 
use App\Models\GlobalUom; 
use Illuminate\Support\Facades\Auth; 

class SupplierListController extends Controller
{
    public function getSupplierList()
    {
    
        $list = SupplierList::where('is_draft','=', 0)->whereNull('deleted_at')->with('SupplierGroup')->with('PaymentTerm')->with('AccountPayable');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('supplier_name','LIKE','%'.$keyword.'%')
                    ->orWhere('supplier_shortname','LIKE','%'.$keyword.'%')
                    ->orWhere('tax_identification_no','LIKE','%'.$keyword.'%');
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
    
        $supplier =  SupplierList::where('is_draft','=', 1)->first();

        if (!$supplier) {
            $auth = \Auth::user();

            $supplier = new SupplierList();
            $supplier->company_id = $auth->company_id;

            $supplier->save();
        }

        $supplier = SupplierList::find($supplier->uuid);
    
        return response()->json(['success' => 1, 'data' => $supplier], 200);
    }

    public function update()
    {
        $supplier =  SupplierList::find(request()->uuid);
        
        if (!$supplier) {
            return response()->json(['success' => 0, 'data' => null, 'Supplier not found'], 500);
        }

        $auth = \Auth::user();
        $supplier->company_id = $auth->company_id;
        $supplier->supplier_name = request()->supplier_name;
        $supplier->supplier_shortname = request()->supplier_shortname;
        $supplier->tax_identification_no = request()->tax_identification_no;
        $supplier->vat_uuid = request()->vat_uuid;
        $supplier->ewt_uuid = request()->ewt_uuid;
        $supplier->supplier_group_uuid = request()->supplier_group_uuid;
        $supplier->lead_time = request()->lead_time;
        $supplier->is_transporter = request()->is_transporter;
        $supplier->payment_term_uuid = request()->payment_term_uuid;
        $supplier->coa_payable_account_uuid = request()->coa_payable_account_uuid;
        $supplier->email = request()->email;
        $supplier->contact_no = request()->contact_no;
        $supplier->global_address_uuid = request()->global_address_uuid;
        $supplier->address1 = request()->address1;
        $supplier->is_draft = 0;
        $supplier->save();

        $supplier = SupplierList::find($supplier->uuid);
        return response()->json(['success' => 1, 'rows' => $supplier], 200);
    }

    public function show($supplierUUID) // set update records
    {
        $supplier = SupplierList::with('SupplierGroup')->with('PaymentTerm')->with('AccountPayable')->find($supplierUUID);

        if (!$supplier) {
            return response()->json(['success' => 0, 'data' => null, 'Supplier not found'], 500);
        }
        return response()->json(['success' => 1, 'data' => $supplier], 200);
    }


    public function delete()
    {
        $supplier = SupplierList::find(request()->uuid)->delete();
        return response()->json(['success' => 1, 'message' => 'Supplier Deleted!'], 200);
    }

    public function getSupplierItems($supplier_uuid)
    {
        $supplier = SupplierList::find($supplier_uuid);
        $supplier_item_uuids = ItemSupplier::where('supplier_uuid','=',$supplier_uuid)->pluck('item_uuid')->toArray();

        $items = ItemList::whereIn('uuid',$supplier_item_uuids);

        if (isset($_GET['is_purchase_item']) && $_GET['is_purchase_item'] == 'yes' ) {
            $items = $items->where('is_purchase_item','=',true);
        }

        if (isset($_GET['discount_group_uuid']) ) {
            $items = $items->where('item_discount_group_uuid','=',$_GET['discount_group_uuid']);
        }

        $items = $items->get();

        if (isset($_GET['with_uoms']) && $_GET['with_uoms'] == 'yes' ) {

            foreach ($items as $item) {
                $uoms = ItemUom::leftJoin('global_uom','global_uom_uuid','=','global_uom.uuid')
                ->where('item_uuid','=',$item->uuid)
                ->orderBy('packing_qtty')
                ->select('global_uom.uuid as uuid','global_uom.uom as uom','packing_qtty')
                ->get();
   
                $item->uoms = $uoms;
                $item->quantity = 0;
            }
        }
        
     
        
        return response()->json(['success' => 1, 'rows' => $items], 200);
    }
}