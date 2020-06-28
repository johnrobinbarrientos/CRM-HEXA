<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\User; 
use Illuminate\Support\Facades\Auth; 

class UserController extends Controller
{
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