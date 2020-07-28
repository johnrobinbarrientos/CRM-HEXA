<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\GlobalAddressList; 
use Illuminate\Support\Facades\Auth; 

class GlobalAddressListController extends Controller
{
    public function getAllAddressList()
    {
        $addressList = GlobalAddressList::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $addressList], 200);
    }

    public function save()
    {
        $addressList = new GlobalAddressList();
        $auth = \Auth::user();
        $addressList->barangay = request()->barangay;
        $addressList->city_municipality = request()->city_municipality;
        $addressList->province = request()->province;
        $addressList->region = request()->region;
        $addressList->country = request()->country;
        $addressList->postal_code = request()->postal_code;
        $addressList->save();

        $addressList = GlobalAddressList::find($addressList->uuid);
        return response()->json(['success' => 1, 'data' => $addressList, 'message' => 'Address Added!'], 200); 
    }


    public function update()
    {
        $addressList = GlobalAddressList::find(request()->uuid);

        if (!$addressList) {
            return response()->json(['success' => 0, 'message' => 'Could not find Address!'], 200);
        }

        $addressList->barangay = request()->barangay;
        $addressList->city_municipality = request()->city_municipality;
        $addressList->province = request()->province;
        $addressList->region = request()->region;
        $addressList->country = request()->country;
        $addressList->postal_code = request()->postal_code;
        $addressList->save();
        
        return response()->json(['success' => 1, 'data' => $addressList, 'message' => 'Address Updated!'], 200); 
    }

    public function delete()
    {
        $addressList = GlobalAddressList::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Address Deleted!'], 200);
    }
}