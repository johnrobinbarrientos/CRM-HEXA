<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\User; 
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
        $users = User::all();
        return response()->json(['success' => 1, 'rows' => $users], 200);
    }

    public function store()
    {
        $user = new User();
        $user->company_id = request()->company_id;
        $user->first_name = request()->first_name;
        $user->last_name = request()->last_name;
        $user->email = request()->email;
        $user->phone = request()->phone;
        $user->password = \Hash::make('secret123');
        $user->save();
        
        return response()->json(['success' => 1, 'data' => $user, 'message' => 'User Added!'], 200); 
    }


    public function update()
    {
        $user = User::find(request()->id);

        if (!$user) {
            return response()->json(['success' => 0, 'message' => 'Could not find user!'], 200);
        }

        $user->company_id = request()->company_id;
        $user->first_name = request()->first_name;
        $user->last_name = request()->last_name;
        $user->email = request()->email;
        $user->phone = request()->phone;
        $user->save();
        
        return response()->json(['success' => 1, 'data' => $user, 'message' => 'User Updated!'], 200); 
    }
}