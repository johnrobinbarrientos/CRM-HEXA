<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyPaymentTerm; 
use Illuminate\Support\Facades\Auth; 

class CompanyPaymentTermController extends Controller
{
    public function getAllPaymentTerm()
    {
        $companyPaymentTerm = CompanyPaymentTerm::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $companyPaymentTerm], 200);
    }

    public function save()
    {
        $companyPaymentTerm = new CompanyPaymentTerm();
        $auth = \Auth::user();
        $companyPaymentTerm->company_id = $auth->company_id;
        $companyPaymentTerm->term = request()->term;
        $companyPaymentTerm->save();

        $companyPaymentTerm = CompanyPaymentTerm::find($companyPaymentTerm->uuid);
        return response()->json(['success' => 1, 'data' => $companyPaymentTerm, 'message' => 'Company Payment Term Added!'], 200); 
    }


    public function update()
    {
        $companyPaymentTerm = CompanyPaymentTerm::find(request()->uuid);

        if (!$companyPaymentTerm) {
            return response()->json(['success' => 0, 'message' => 'Could not find Company Payment Term!'], 200);
        }

        $companyPaymentTerm->term = request()->term;
        $companyPaymentTerm->save();
        
        return response()->json(['success' => 1, 'data' => $companyPaymentTerm, 'message' => 'Company Payment Term Updated!'], 200); 
    }

    public function delete()
    {
        $companyPaymentTerm = CompanyPaymentTerm::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Company Payment Term Deleted!'], 200);
    }
}