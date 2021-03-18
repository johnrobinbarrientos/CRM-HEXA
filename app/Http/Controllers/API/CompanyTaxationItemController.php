<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyTaxationItem; 
use Illuminate\Support\Facades\Auth; 

class CompanyTaxationItemController extends Controller
{
    public function index()
    {
        $list = CompanyTaxationItem::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('tax_type','LIKE','%'.$keyword.'%')
                ->orWhere('tax_name','LIKE','%'.$keyword.'%')
                ->orWhere('shortname','LIKE','%'.$keyword.'%');
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


    public function getDetails()
    {
        $taxationItem = CompanyTaxationItem::find(request()->uuid);
        return response()->json(['success' => 1, 'rows' => $taxationItem], 200);
    }

    public function getRecords()
    {
        $taxationItem = CompanyTaxationItem::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $taxationItem], 200);
    }

    public function save()
    {
        $taxationItem = request()->uuid ? CompanyTaxationItem::find(request()->uuid) : new CompanyTaxationItem();
        $taxationItem->tax_type = request()->tax_type;
        $taxationItem->tax_name = request()->tax_name;
        $taxationItem->shortname = request()->shortname;
        $taxationItem->save();

        $taxationItem = CompanyTaxationItem::find($taxationItem->uuid);

        return response()->json(['success' => 1, 'rows' => $taxationItem], 200);
    }

    public function delete()
    {
        $companyTaxation = CompanyTaxationItem::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Company Taxation Deleted!'], 200);
    }

}