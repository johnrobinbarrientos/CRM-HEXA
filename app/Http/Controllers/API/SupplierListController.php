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

use App\Models\BDSupplier; 
use App\Models\BDSupplierDiscount; 
use App\Models\BDSupplierDiscountExcludedItem; 

use Illuminate\Support\Facades\Auth; 


use  App\Http\Controllers\API\BDSupplierController;
use  App\Http\Controllers\API\SupplierCheckPayeeController;
use  App\Http\Controllers\API\SupplierContactController;

class SupplierListController extends Controller
{
    public function index()
    {
    
        $list = SupplierList::whereNull('deleted_at')->with('SupplierGroup')->with('PaymentTerm')->with('AccountPayable');

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

        $children = (object) request()->children;

        $groups = (isset($children->discount_groups)) ? $children->discount_groups : [];
        $check = BDSupplierController::check($groups);

        if ($check['errors'] > 0) {
           return response()->json(['success' => 0, 'groups' => $check['groups'], 'errors' => $check['errors'], 'tab' => 'discounts' ], 500);
        }


        $payees = (isset($children->payees)) ? $children->payees : [];
        $check = SupplierCheckPayeeController::check($payees);

        if ($check['errors'] > 0) {
           return response()->json(['success' => 0, 'payees' => $check['payees'], 'errors' => $check['errors'], 'tab' => 'check-payees' ], 500);
        }

        $contacts = (isset($children->contacts)) ? $children->contacts : [];
        $check = SupplierContactController::check($contacts);

        if ($check['errors'] > 0) {
           return response()->json(['success' => 0, 'contacts' => $check['contacts'], 'errors' => $check['errors'], 'tab' => 'check-contacts' ], 500);
        }

        $supplier =  SupplierList::find($uuid);
        $supplier = ($supplier) ? $supplier : new SupplierList();

        $supplier->supplier_name = request()->supplier_name;
        $supplier->supplier_shortname = request()->supplier_shortname;
        $supplier->tax_identification_no = request()->tax_identification_no;
        $supplier->vat_uuid = (request()->is_vat) ? request()->vat_uuid : null;
        $supplier->ewt_uuid = (request()->is_ewt) ? request()->ewt_uuid : null;
        $supplier->supplier_group_uuid = request()->supplier_group_uuid;
        $supplier->lead_time = request()->lead_time;
        $supplier->is_transporter = request()->is_transporter;
        $supplier->is_active = request()->is_active;
        $supplier->payment_term_uuid = request()->payment_term_uuid;
        $supplier->coa_payable_account_uuid = request()->coa_payable_account_uuid;
        $supplier->coa_expense_account_uuid = request()->coa_expense_account_uuid;
        $supplier->email = request()->email;
        $supplier->contact_no = request()->contact_no;
        $supplier->address_uuid = request()->address_uuid;
        $supplier->address1 = request()->address1;
        $supplier->cost_center_uuid = request()->cost_center_uuid;
        $supplier->save();

        $supplier = SupplierList::find($supplier->uuid);
        $bd_groups_save = BDSupplierController::save($supplier->uuid,$groups);
        $check_payees_save = SupplierCheckPayeeController::save($supplier->uuid,$payees);
        $contacts_save = SupplierContactController::save($supplier->uuid,$contacts);

       //  $BD_groups = BDSupplier::where('supplier_uuid','=',$supplier->uuid)->with('discounts')->get();

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

    public function delete($supplier_uuid)
    {
        $supplier = SupplierList::find($supplier_uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
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