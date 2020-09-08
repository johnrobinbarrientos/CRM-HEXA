<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ItemDiscountGroup; 
use Illuminate\Support\Facades\Auth; 

class ItemDiscountGroupController extends Controller
{
    public function getItemDiscountGroup()
    {
        $discountGroup = ItemDiscountGroup::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $discountGroup], 200);
    }


    public function save()
    {
        $discountGroup = request()->uuid ? ItemDiscountGroup::find(request()->uuid) : new ItemDiscountGroup();
        $auth = \Auth::user();
        $discountGroup->company_id = $auth->company_id;
        $discountGroup->group_name = request()->group_name;
        $discountGroup->group_rate = request()->group_rate;
        $discountGroup->save();

        $discountGroup = ItemDiscountGroup::find($discountGroup->uuid);

        return response()->json(['success' => 1, 'rows' => $discountGroup], 200);
    }

    public function delete()
    {
        $discountGroup = ItemDiscountGroup::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}