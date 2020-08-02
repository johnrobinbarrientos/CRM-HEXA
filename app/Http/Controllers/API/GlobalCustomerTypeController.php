<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\GlobalCustomerType; 
use Illuminate\Support\Facades\Auth; 

class GlobalCustomerTypeController extends Controller
{
    public function getCustomerTypes()
    {
        $types = GlobalCustomerType::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $types], 200);
    }

    public function save()
    {
        $types = request()->uuid ? GlobalCustomerType::find(request()->uuid) : new GlobalCustomerType();
        $types->customer_type = request()->customer_type;
        $types->save();

        $types = GlobalCustomerType::find($types->uuid);

        return response()->json(['success' => 1, 'rows' => $types], 200);
    }


    public function delete()
    {
        $types = GlobalCustomerType::find(request()->uuid)->delete();
        return response()->json(['success' => 1, 'rows' => $types], 200);
    }
}