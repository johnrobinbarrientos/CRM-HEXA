<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyList; 
use App\Models\User;

use App\Jobs\SendEmail;

use Illuminate\Support\Facades\Auth; 

class CompanyDetailsController extends Controller
{
    public function getCompanyList()
    {
        $company = CompanyList::whereNull('deleted_at')->with('AddressList')->get();
        return response()->json(['success' => 1, 'rows' => $company], 200);
    }

}