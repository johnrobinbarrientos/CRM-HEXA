<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ProjectScopeOfWork; 
use Illuminate\Support\Facades\Auth; 

class ProjectScopeOfWorkController extends Controller
{
    public function index()
    {
        $list = ProjectScopeOfWork::whereNull('deleted_at')
        ->with('ProjectType');

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

    public function show($projectTypeUUID)
    {
        $scopeOfWork = ProjectScopeOfWork::where('project_type_uuid','=',$projectTypeUUID)->get();
        return response()->json(['success' => 1, 'rows' => $scopeOfWork], 200);
    }

    public function save($projectTypeUUID)
    {
        $scopeOfWork = request()->uuid ? ProjectScopeOfWork::find(request()->uuid) : new ProjectScopeOfWork();

        $scopeOfWork->project_type_uuid = $projectTypeUUID;
        $scopeOfWork->scope_of_work = request()->scope_of_work;
        $scopeOfWork->save();
        
        $scopeOfWork = ProjectScopeOfWork::find($scopeOfWork->uuid);

        return response()->json(['success' => 1, 'data' => $scopeOfWork], 200);
    }

    public function saveScope()
    {
        $scopeOfWork = request()->uuid ? ProjectScopeOfWork::find(request()->uuid) : new ProjectScopeOfWork();

        $scopeOfWork->project_type_uuid = request()->project_type_uuid;
        $scopeOfWork->scope_of_work = request()->scope_of_work;
        $scopeOfWork->save();

        $scopeOfWork = ProjectScopeOfWork::find($scopeOfWork->uuid);

        return response()->json(['success' => 1, 'rows' => $scopeOfWork], 200);
    }
}