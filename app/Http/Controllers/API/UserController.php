<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\User; 
use Illuminate\Support\Facades\Auth; 

class UserController extends Controller
{
    public function login() { 
        try
        {
            if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) { 
                $user = Auth::user(); 
				$token =  $user->createToken('WEB')->accessToken; 
			    return response()->json(['success' => 1, 'token' => $token, 'user' => $user, 'message' => 'Authenticated!'], 200); 
            } else { 
                return response()->json(['success' => 0, 'message' => 'Invalid username and password!'], 401); 
            } 
        } catch (Exception $e) {
            return response()->json(['success' => 0, 'message' => 'Invalid username and password!'], 401);
        }
    }

    public function index()
    {
        $users = User::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $users], 200);
    }

    public function store()
    {
        $user = new User();
        $user->first_name = request()->firstname;
        $user->last_name = request()->lastname;
        $user->email = request()->email;
        $user->password = \Hash::make(request()->password);
        $user->save();
        
        return response()->json(['success' => 1, 'data' => $user, 'message' => 'User Added!'], 200); 
    }
}