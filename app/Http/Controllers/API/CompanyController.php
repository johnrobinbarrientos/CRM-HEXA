<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\Company; 
use Illuminate\Support\Facades\Auth; 

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $companies], 200);
    }

    public function store()
    {
        $company = new Company();
        $company->name = request()->name;
        $company->phone = request()->phone;
        $company->address = request()->address;
        $company->description = request()->description;
        $company->save();
        
        return response()->json(['success' => 1, 'data' => $company, 'message' => 'Company Added!'], 200); 
    }

    public function update2(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->update($request->all());

        return response()->json(['success' => 1, 'data' => $company, 'message' => 'Company Updated!'], 200); 
    }


    public function update()
    {
        $company = Company::find(request()->id);

        if (!$company) {
            return response()->json(['success' => 0, 'message' => 'Could not find company!'], 200);
        }

        $company->name = request()->name;
        $company->phone = request()->phone;
        $company->address = request()->address;
        $company->description = request()->description;
        $company->save();
        
        return response()->json(['success' => 1, 'data' => $company, 'message' => 'Company Updated!'], 200); 
    }

    public function delete(Company $company)
    {
        $company->delete();

        return response()->json(['success' => 1, 'message' => 'Company Deleted!'], 200);
    }
}