<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\Location; 
use Illuminate\Support\Facades\Auth; 

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $locations], 200);
    }

    public function store()
    {
        $location = new Location();
        $auth = \Auth::user();
        $location->company_id = $auth->company_id;
        $location->location_code = request()->location_code;
        $location->location_name = request()->location_name;
        $location->location_shortname = request()->location_shortname;
        $location->is_group = 0;
        $location->save();

        $location = Location::find($location->uuid);
        return response()->json(['success' => 1, 'data' => $location, 'message' => 'Location Added!'], 200); 
    }

    public function update2(Request $request, $id)
    {
        $location = Location::findOrFail($id);
        $location->update($request->all());

        return response()->json(['success' => 1, 'data' => $location, 'message' => 'Location Updated!'], 200); 
    }


    public function update()
    {
        $location = Location::find(request()->uuid);

        if (!$location) {
            return response()->json(['success' => 0, 'message' => 'Could not find location!'], 200);
        }

        $location->location_code = request()->location_code;
        $location->location_name = request()->location_name;
        $location->location_shortname = request()->location_shortname;
        $location->save();
        
        return response()->json(['success' => 1, 'data' => $location, 'message' => 'Location Updated!'], 200); 
    }

    public function delete(Location $location)
    {
        $location->delete();

        return response()->json(['success' => 1, 'message' => 'Location Deleted!'], 200);
    }
}