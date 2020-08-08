<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyTaxation; 
use Illuminate\Support\Facades\Auth; 

class CompanyTaxationController extends Controller
{
    public function getTaxation()
    {
        $companyTaxation = CompanyTaxation::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $companyTaxation], 200);
    }

    public function save()
    {
        $companyTaxation = request()->uuid ? CompanyTaxation::find(request()->uuid) : new CompanyTaxation();
        $auth = \Auth::user();
        $companyTaxation->company_id = $auth->company_id;
        $companyTaxation->tax_type = request()->tax_type;
        $companyTaxation->tax_name = request()->tax_name;
        $companyTaxation->tax_rate = request()->tax_rate;
        $companyTaxation->save();

        $companyTaxation = CompanyTaxation::find($companyTaxation->uuid);

        return response()->json(['success' => 1, 'rows' => $companyTaxation], 200);
    }

    public function delete()
    {
        $companyTaxation = CompanyTaxation::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Company Taxation Deleted!'], 200);
    }

    public function getVAT()
    {
        $vat = CompanyTaxation::whereNull('deleted_at')->where('tax_type','VAT')->get();
        return response()->json(['success' => 1, 'rows' => $vat], 200);
    }

    public function getEWT()
    {
        $ewt = CompanyTaxation::whereNull('deleted_at')->where('tax_type','EWT')->get();
        return response()->json(['success' => 1, 'rows' => $ewt], 200);
    }

    public function getWT()
    {
        $wt = CompanyTaxation::whereNull('deleted_at')->where('tax_type','WT')->get();
        return response()->json(['success' => 1, 'rows' => $wt], 200);
    }
}