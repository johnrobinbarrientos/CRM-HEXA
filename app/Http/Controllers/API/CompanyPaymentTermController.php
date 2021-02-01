<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyPaymentTerm; 
use Illuminate\Support\Facades\Auth; 

class CompanyPaymentTermController extends Controller
{
    public function getPaymentTerm()
    {
        $list = CompanyPaymentTerm::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('term','LIKE','%'.$keyword.'%');
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

    public function save()
    {
        $companyPaymentTerm = request()->uuid ? CompanyPaymentTerm::find(request()->uuid) : new CompanyPaymentTerm();
        $companyPaymentTerm->term = request()->term;
        $companyPaymentTerm->save();

        $companyPaymentTerm = CompanyPaymentTerm::find($companyPaymentTerm->uuid);

        return response()->json(['success' => 1, 'rows' => $companyPaymentTerm], 200);
    }

    public function delete()
    {
        $companyPaymentTerm = CompanyPaymentTerm::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Company Payment Term Deleted!'], 200);
    }
}