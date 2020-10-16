<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyAccountingPeriod; 
use Illuminate\Support\Facades\Auth; 

class CompanyAccountingPeriodController extends Controller
{
    public function getAccountingPeriod()
    {
        $list = CompanyAccountingPeriod::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('year_name','LIKE','%'.$keyword.'%');
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

    public function save()
    {
        $period = request()->uuid ? CompanyAccountingPeriod::find(request()->uuid) : new CompanyAccountingPeriod();
        $auth = \Auth::user();
        $period->company_id = $auth->company_id;
        $period->year_name = request()->year_name;
        $period->jan_is_open = request()->jan_is_open;
        $period->feb_is_open = request()->feb_is_open;
        $period->mar_is_open = request()->mar_is_open;
        $period->apr_is_open = request()->apr_is_open;
        $period->may_is_open = request()->may_is_open;
        $period->jun_is_open = request()->jun_is_open;
        $period->jul_is_open = request()->jul_is_open;
        $period->aug_is_open = request()->aug_is_open;
        $period->sep_is_open = request()->sep_is_open;
        $period->oct_is_open = request()->oct_is_open;
        $period->nov_is_open = request()->nov_is_open;
        $period->dec_is_open = request()->dec_is_open;
        $period->save();

        $period = CompanyAccountingPeriod::find($period->uuid);

        return response()->json(['success' => 1, 'rows' => $period], 200);
    }

}