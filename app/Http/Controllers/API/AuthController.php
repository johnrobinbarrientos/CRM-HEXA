<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\User;
use App\Models\CompanyList; 
use Illuminate\Support\Facades\Auth; 

class AuthController extends Controller
{

    public function check()
    {
        $user = Auth::user();
        return response()->json(['success' => 1, 'user' => $user, 'authenticated' => true], 200);
    }

    public function revoke()
    {
        $user = Auth::user();
        $user->token()->revoke(); 
        return response()->json(['success' => 1, 'authenticated' => true], 200);
    }


    public function register(Request $request)
    {
        $validatedUserData = $request->validate([
            'first_name' => 'required|max:40',
            'last_name' => 'required|max:40',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedCompanyData = $request->validate([
            'name' => 'required|max:40'
        ]);

        $validatedUserData['password'] = \Hash::make(request()->password);
        
        $user = User::create($validatedUserData);

        $company = new CompanyList();
        $company->company_name = $validatedCompanyData['company_name'];
        $company->save();

        $user->company_id = $company->id;
        $user->save(); 
       

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['success' => 1, 'user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        try
        {
            if(Auth::attempt($loginData)) { 
                $user = Auth::user(); 
                $token =  $user->createToken('authToken')->accessToken; 
                return response()->json(['success' => 1, 'token' => $token, 'user' => $user, 'message' => 'Authenticated!'], 200); 
            } else { 
                return response()->json(['success' => 0, 'message' => 'Invalid username and password!'], 401); 
            } 
        } catch (Exception $e) {
            return response()->json(['success' => 0, 'message' => 'Invalid username and password!'], 401);
        }

    }
}