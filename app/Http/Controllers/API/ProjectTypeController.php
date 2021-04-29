<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ProjectType;
use App\Models\ProjectTypeScope;
use Illuminate\Support\Facades\Auth; 

class ProjectTypeController extends Controller
{
    public function index()
    {
        $list = ProjectType::whereNull('deleted_at')->with('TypeScopes');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('type','LIKE','%'.$keyword.'%');
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

    public function save()
    {

        $projectType = request()->uuid ? ProjectType::find(request()->uuid) : new ProjectType();

        $projectType->type = request()->type;
        $projectType->save();

        $projectType = ProjectType::find($projectType->uuid);


        $scope_uuids = request()->scope_uuids;
        $type_scopes = ProjectTypeScope::where('project_type_uuid', '=', $projectType->uuid)->delete();

        foreach ($scope_uuids as $scope_uuid) {
            $type_scope = ProjectTypeScope::where('project_type_uuid','=',$projectType->uuid)->where('project_scope_uuid','=',$scope_uuid)->withTrashed()->first();
            $type_scope = (!$type_scope) ? new ProjectTypeScope : $type_scope;
            $type_scope->project_type_uuid = $projectType->uuid;
            $type_scope->project_scope_uuid = $scope_uuid;
            $type_scope->deleted_at = null;
            $type_scope->save();
        }

        // $projectType = ProjectType::find($item->uuid);

        return response()->json(['success' => 1, 'rows' => $projectType], 200);
    }


    public function delete($project_type_uuid)
    {
        $projectType = ProjectType::find($project_type_uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}