<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\User;
use App\Models\CompanyBranch;
use App\Models\CompanyBranchLocation;
use App\Models\EmployeeList; 

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

        $user->first_name = request()->first_name;
        $user->last_name = request()->last_name;
        $user->email = request()->email;
        $user->phone = request()->phone;
        $user->save();
        
        return response()->json(['success' => 1, 'data' => $user, 'message' => 'User Updated!'], 200); 
    }

    // public function getBranch()
    // {
    //     $auth = \Auth::user();

    //     $branch = EmployeeList::select('branch_name', 'branch_uuid', 'branch_shortname')
    //     ->leftJoin('company_branch_location', 'employee_list.branch_location_uuid', '=', 'company_branch_location.uuid')
    //     ->leftJoin('company_branch', 'company_branch_location.branch_uuid', '=', 'company_branch.uuid')
    //     ->where('user_id', $auth->id)
    //     ->first();

    //     return response()->json(['success' => 1, 'rows' => $branch], 200);

    // }

    public function getBranch()
    {

        $auth = \Auth::user();

        $branch = EmployeeList::select('branch_name', 'branch_uuid', 'branch_shortname')
        ->leftJoin('company_branch', 'employee_list.branch_uuid', '=', 'company_branch.uuid')
        ->where('user_id', $auth->id)
        ->first();

        return response()->json(['success' => 1, 'rows' => $branch], 200);

    }

    public function getUserInfo()
    {

        $auth = \Auth::user();

        $user = EmployeeList::where('user_id', $auth->id)->with('Branch')->with('BranchLocation')->first();

        return response()->json(['success' => 1, 'data' => $user], 200);

    }

    // public function getBranchLocations()
    // {
    //     $auth = \Auth::user();

    //     $branch = EmployeeList::select('branch_uuid')
    //     ->leftJoin('company_branch_location', 'employee_list.branch_location_uuid', '=', 'company_branch_location.uuid')
    //     ->leftJoin('company_branch', 'company_branch_location.branch_uuid', '=', 'company_branch.uuid')
    //     ->where('user_id', $auth->id)
    //     ->first();


    //     $locations= CompanyBranchLocation::where('branch_uuid', $branch->branch_uuid)->get();

    //     return response()->json(['success' => 1, 'rows' => $locations], 200);

    // }

    public function getBranchLocations($branch_uuid)
    {

        $locations= CompanyBranchLocation::where('branch_uuid', $branch_uuid)->get();

        return response()->json(['success' => 1, 'rows' => $locations], 200);

    }



}