<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\LocationGroup; 
use Illuminate\Support\Facades\Auth; 

class LocationGroupController extends Controller
{
    public function index()
    {
        $locationGroup = LocationGroup::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $locationGroup], 200);
    }

    public function store()
    {
        $locationGroup = new LocationGroup();
        $auth = \Auth::user();
        $locationGroup->company_id = $auth->company_id;
        $locationGroup->location_group_name = request()->location_group_name;
        $locationGroup->save();

        $locationGroup = LocationGroup::find($locationGroup->uuid);
        return response()->json(['success' => 1, 'data' => $locationGroup, 'message' => 'Location Group Added!'], 200); 
    }

    public function update2(Request $request, $id)
    {
        $locationGroup = LocationGroup::findOrFail($id);
        $locationGroup->update($request->all());

        return response()->json(['success' => 1, 'data' => $locationGroup, 'message' => 'Location Group Updated!'], 200); 
    }


    public function update()
    {
        $locationGroup = LocationGroup::find(request()->uuid);

        if (!$locationGroup) {
            return response()->json(['success' => 0, 'message' => 'Could not find Group location!'], 200);
        }

        $locationGroup->location_group_name = request()->location_group_name;
        $locationGroup->save();
        
        return response()->json(['success' => 1, 'data' => $locationGroup, 'message' => 'Location Group Updated!'], 200); 
    }

    public function delete(Location $locationGroup)
    {
        $locationGroup->delete();

        return response()->json(['success' => 1, 'message' => 'Location Group Deleted!'], 200);
    }
}