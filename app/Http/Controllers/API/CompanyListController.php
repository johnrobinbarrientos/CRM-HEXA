<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyList; 
use Illuminate\Support\Facades\Auth; 

class CompanyListController extends Controller
{
    public function getCompanyList()
    {
        $company = CompanyList::whereNull('deleted_at')->with('AddressList')->get();
        return response()->json(['success' => 1, 'rows' => $company], 200);
    }

    public function save()
    {
        $company = request()->id ? CompanyList::find(request()->id) : new CompanyList();
        $company->company_name = request()->company_name;
        $company->shortname = request()->shortname;
        $company->tagline = request()->tagline;
        $company->website = request()->website;
        $company->email = request()->email;
        $company->contact_no = request()->contact_no;
        $company->tax_id_no = request()->tax_id_no;
        $company->prefix = request()->prefix;
        $company->global_address_uuid = request()->global_address_uuid;
        $company->save();

        $company = CompanyList::find($company->id);

        return response()->json(['success' => 1, 'rows' => $company], 200);
    }


    public function delete()
    {
        $company = CompanyList::find(request()->id)->delete();
        return response()->json(['success' => 1, 'rows' => $company], 200);
    }
}