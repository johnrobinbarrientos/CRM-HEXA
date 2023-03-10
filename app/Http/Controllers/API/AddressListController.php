<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\AddressList; 
use Illuminate\Support\Facades\Auth; 

class AddressListController extends Controller
{
    public function index()
    {
        $list = AddressList::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('barangay','LIKE','%'.$keyword.'%')
                ->orWhere('city_municipality','LIKE','%'.$keyword.'%')
                ->orWhere('province','LIKE','%'.$keyword.'%')
                ->orWhere('region','LIKE','%'.$keyword.'%')
                ->orWhere('country','LIKE','%'.$keyword.'%')
                ->orWhere('postal_code','LIKE','%'.$keyword.'%');
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

    public function getAll()
    {
        $list = AddressList::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $list], 200);
    }

    public function save()
    {
        $addressList = request()->uuid ? AddressList::find(request()->uuid) : new AddressList();
        $auth = \Auth::user();
        $addressList->barangay = request()->barangay;
        $addressList->city_municipality = request()->city_municipality;
        $addressList->province = request()->province;
        $addressList->region = request()->region;
        $addressList->country = request()->country;
        $addressList->postal_code = request()->postal_code;
        $addressList->save();

        $addressList = AddressList::find($addressList->uuid);

        return response()->json(['success' => 1, 'rows' => $addressList], 200);
    }

    public function delete()
    {
        $addressList = AddressList::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Address Deleted!'], 200);
    }
}