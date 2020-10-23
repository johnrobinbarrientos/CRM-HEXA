<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CustomerGroup; 
use Illuminate\Support\Facades\Auth; 

class CustomerGroupController extends Controller
{
    public function getCustomerGroup()
    {
        $list = CustomerGroup::whereNull('deleted_at');
        
        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('group_name','LIKE','%'.$keyword.'%');
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
        $customerGroup = request()->uuid ? CustomerGroup::find(request()->uuid) : new CustomerGroup();
        $auth = \Auth::user();
        $customerGroup->company_id = $auth->company_id;
        $customerGroup->group_name = request()->group_name;
        $customerGroup->markup_rate = request()->markup_rate;
        $customerGroup->save();

        $customerGroup = CustomerGroup::find($customerGroup->uuid);

        return response()->json(['success' => 1, 'rows' => $customerGroup], 200);
    }

    public function delete()
    {
        $customerGroup = CustomerGroup::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Customer Group Deleted!'], 200);
    }
}