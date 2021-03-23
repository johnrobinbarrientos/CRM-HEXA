<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierCheckPayee; 
use Illuminate\Support\Facades\Auth; 

class SupplierCheckPayeeController extends Controller
{
    public function index()
    {
        $list = SupplierCheckPayee::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('check_payee','LIKE','%'.$keyword.'%');
            });
        }

        $count = $list->count();

        // pagination
        $take = (is_numeric(request()->take) && request()->take <= 50) ? request()->take: 20;
        $page = (is_numeric(request()->page)) ? request()->page : 1;
        $offset = (($page - 1 ) * $take);

        $list = $list->take($take);
        $list = $list->offset($offset);
        $list = $list->get();

        return response()->json(['success' => 1, 'rows' => $list, 'count' => $count], 200);
    }

    public function getCheckPayeeBySupplier($supplierUUID)
    {
        $list = SupplierCheckPayee::where('supplier_uuid','=',$supplierUUID)->whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $list], 200);
    }

    static public function check($payees)
    {
        $errors = 0;
        foreach ($payees as $key => $payee) {

            $payee['check_payee_error'] = false;


            if (empty($payee['check_payee'])) {
                $payee['check_payee_error'] = true;
                $errors++;
            }


            $payees[$key] = $payee;
        }

        return ['payees' => $payees, 'errors' => $errors];
    }

    static public function save($supplier_uuid,$payees)
    {
        foreach ($payees as $key => $payee) {

            $uuid = $payee['uuid'];
            $check_payee = $payee['check_payee'];
    
            
            $data = SupplierCheckPayee::where('uuid','=',$uuid)->first();
            $data = ($data) ? $data : new  SupplierCheckPayee;
            $data->supplier_uuid = $supplier_uuid;
            $data->check_payee = $check_payee;
            $data->save();
            
            $bd_supplier = SupplierCheckPayee::find($data->uuid);
        }
    }

    public function saveOld()
    {
        $checkPayee = request()->uuid ? SupplierCheckPayee::find(request()->uuid) : new SupplierCheckPayee();

        $checkPayee->supplier_uuid = request()->supplier_uuid;
        $checkPayee->check_payee = request()->check_payee;
        $checkPayee->save();

        $checkPayee = SupplierCheckPayee::find($checkPayee->uuid);

        return response()->json(['success' => 1, 'data' => $checkPayee], 200);
    }

    public function delete($supplierUUID,$checkPayeeUUID) {
        
        $checkPayee = SupplierCheckPayee::find($checkPayeeUUID)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}