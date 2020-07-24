<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyTaxation; 
use Illuminate\Support\Facades\Auth; 

class CompanyTaxationController extends Controller
{
    public function getAllTaxation()
    {
        $companyTaxation = CompanyTaxation::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $companyTaxation], 200);
    }

    public function save()
    {
        $companyTaxation = new CompanyTaxation();
        $auth = \Auth::user();
        $companyTaxation->company_id = $auth->company_id;
        $companyTaxation->tax_type = request()->tax_type;
        $companyTaxation->tax_name = request()->tax_name;
        $companyTaxation->tax_rate = request()->tax_rate;
        $companyTaxation->save();

        $companyTaxation = CompanyTaxation::find($companyTaxation->uuid);
        return response()->json(['success' => 1, 'data' => $companyTaxation, 'message' => 'Company Taxation Added!'], 200); 
    }


    public function update()
    {
        $companyTaxation = CompanyTaxation::find(request()->uuid);

        if (!$companyTaxation) {
            return response()->json(['success' => 0, 'message' => 'Could not find Company Taxation!'], 200);
        }

        $companyTaxation->tax_type = request()->tax_type;
        $companyTaxation->tax_name = request()->tax_name;
        $companyTaxation->tax_rate = request()->tax_rate;
        $companyTaxation->save();
        
        return response()->json(['success' => 1, 'data' => $companyTaxation, 'message' => 'Company Taxation Updated!'], 200); 
    }

    public function delete()
    {
        $companyTaxation = CompanyTaxation::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Company Taxation Deleted!'], 200);
    }
}