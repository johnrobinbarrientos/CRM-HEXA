<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ProjectType; 
use Illuminate\Support\Facades\Auth; 

class ProjectTypeController extends Controller
{
    public function index()
    {
        $list = ProjectType::whereNull('deleted_at');

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

        return response()->json(['success' => 1, 'rows' => $projectType], 200);
    }


    public function delete($project_type_uuid)
    {
        $projectType = ProjectType::find($project_type_uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}