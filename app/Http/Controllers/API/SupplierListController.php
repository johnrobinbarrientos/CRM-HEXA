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
        $list = SupplierList::whereNull('deleted_at')->with('SupplierGroup')->with('PaymentTerm')->with('AccountPayable')->get();
        return response()->json(['success' => 1, 'rows' => $list], 200);
    }

    public function save()
    {
        $supplier = request()->uuid ? SupplierList::find(request()->uuid) : new SupplierList();
        $auth = \Auth::user();
        $supplier->company_id = $auth->company_id;
        $supplier->business_name = request()->business_name;
        $supplier->business_shortname = request()->business_shortname;
        $supplier->check_payee = request()->check_payee;
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
        $supplier->save();

        $supplier = SupplierList::find($supplier->uuid);
        return response()->json(['success' => 1, 'rows' => $supplier], 200);
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

        $items = $items->get();

        if (isset($_GET['with_uoms']) && $_GET['with_uoms'] == 'yes' ) {

            foreach ($items as $item) {
                $uoms = ItemUom::leftJoin('global_uom','global_uom_uuid','=','global_uom.uuid')
                ->where('item_uuid','=',$item->uuid)
                ->orderBy('packing_qtty')
                ->select('global_uom.uuid as uuid','global_uom.uom as uom','packing_qtty')
                ->get();
   
                $item->uoms = $uoms;
            }
        }
        
     
        
        return response()->json(['success' => 1, 'rows' => $items], 200);
    }
}