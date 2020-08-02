<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CustomerGroup; 
use Illuminate\Support\Facades\Auth; 

class CustomerGroupController extends Controller
{
    public function getAllCustomerGroup()
    {
        $customerGroup = CustomerGroup::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $customerGroup], 200);
    }

    public function save()
    {
        $customerGroup = request()->uuid ? CustomerGroup::find(request()->uuid) : new CustomerGroup();
        $auth = \Auth::user();
        $customerGroup->company_id = $auth->company_id;
        $customerGroup->group_name = request()->group_name;
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