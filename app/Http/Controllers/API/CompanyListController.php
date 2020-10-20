<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyList; 
use App\Models\User;

use App\Jobs\SendEmail;

use Illuminate\Support\Facades\Auth; 

class CompanyListController extends Controller
{
    public function getCompanyList()
    {
        $list = CompanyList::whereNull('deleted_at')->with('AddressList');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('company_name','LIKE','%'.$keyword.'%')
                ->orWhere('shortname','LIKE','%'.$keyword.'%');
            });
        }

        $count = $list->count();

        // pagination
        $take = (is_numeric(request()->take) && request()->take <= 50) ? request()->take: 20;
        $page = (is_numeric(request()->page)) ? request()->page : 1;
        $offset = (($page - 1 ) * $take);

        $list = $list->take($take);
        $list = $list->offset($offset);
        $list = $list->get();

        return response()->json(['success' => 1, 'rows' => $list, 'count' => $count], 200);
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

        if ($company) {
            $password = self::generateRandomString(8);
            
            $user = new User();
            $user->company_id = $company->id;
            $user->first_name = request()->first_name;
            $user->last_name = request()->first_name;
            $user->email = request()->email;
            $user->type = 'Admin';
            $user->password = \Hash::make($password);
            $user->phone = request()->phone;
            $user->confirmation_token = 'CONF-'.\Uuid::generate(4);
            $user->save();
        }
        
        $company = CompanyList::find($company->id);
        $user = User::find($user->id);

        SendEmail::dispatch('confirmation',['to' => 'kenjimagto@gmail.com', 'data' => ['company' => $company, 'user' => $user]]);

        return response()->json(['success' => 1, 'company' => $company, 'user' => $user], 200);
    }

    static private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function delete()
    {
        $company = CompanyList::find(request()->id)->delete();
        return response()->json(['success' => 1, 'rows' => $company], 200);
    }
}