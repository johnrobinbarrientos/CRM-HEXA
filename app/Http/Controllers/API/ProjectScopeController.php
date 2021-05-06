<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ProjectScope; 
use Illuminate\Support\Facades\Auth; 

use  App\Http\Controllers\API\ProjectScopeDetailController;
use  App\Http\Controllers\API\ProjectTypeController;

class ProjectScopeController extends Controller
{
    public function index()
    {
        $list = ProjectScope::whereNull('deleted_at')->with('ScopeDetails');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('scope_of_work','LIKE','%'.$keyword.'%');
            });
        }

        $count = $list->count();

        // pagination
        $take = (is_numeric(request()->take) && request()->take <= 100) ? request()->take: 20;
        $page = (is_numeric(request()->page)) ? request()->page : 1;
        $offset = (($page - 1 ) * $take);

        $list = $list->take($take);
        $list = $list->offset($offset);
        $list = $list->get();

        return response()->json(['success' => 1, 'rows' => $list, 'count' => $count, 'offset' => $offset, 'results' => count($list)], 200);
    }

    public function getAll()
    {
        $list = ProjectScope::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $list], 200);
    }



    public function save()
    {

        $scopeOfWork = request()->uuid ? ProjectScope::find(request()->uuid) : new ProjectScope();

        $scopeOfWork->scope_of_work = request()->scope_of_work;
        $scopeOfWork->save();
        
        $scopeOfWork = ProjectScope::find($scopeOfWork->uuid);


        $save_details = ProjectScopeDetailController::save($scopeOfWork->uuid,request()->scope_details);

        return response()->json(['success' => 1], 200);

    }

}