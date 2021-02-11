<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyTaxation; 
use Illuminate\Support\Facades\Auth; 

class CompanyTaxationController extends Controller
{
    public function index()
    {
        $list = CompanyTaxation::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('tax_type','LIKE','%'.$keyword.'%')
                ->orWhere('tax_name','LIKE','%'.$keyword.'%');
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

    public function getDetails()
    {
        $details = CompanyTaxation::find(request()->uuid);
        return response()->json(['success' => 1, 'rows' => $details], 200);
    }

    public function save()
    {
        $companyTaxation = request()->uuid ? CompanyTaxation::find(request()->uuid) : new CompanyTaxation();
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