<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ProjectWorkDetail;
use App\Models\ProjectScopeOfWork; 
use Illuminate\Support\Facades\Auth; 

class ProjectWorkDetailController extends Controller
{
    public function index()
    {
        $list = ProjectWorkDetail::whereNull('deleted_at')
        ->with('ScopeOfWork')
        ->with('ProjectType');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('detail','LIKE','%'.$keyword.'%');
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

    public function show($projectscopeUUID)
    {
        $workDetails = ProjectWorkDetail::where('project_scope_uuid','=',$projectscopeUUID)->get();
        return response()->json(['success' => 1, 'rows' => $workDetails], 200);
    }

    public function save($projectscopeUUID)
    {

        $workDetails = request()->uuid ? ProjectWorkDetail::find(request()->uuid) : new ProjectWorkDetail();

        $projectType = ProjectScopeOfWork::find(request()->projectscopeUUID);

        $workDetails->project_type_uuid = $projectType->project_type_uuid;
        $workDetails->project_scope_uuid = $projectscopeUUID;
        $workDetails->detail = request()->detail;
        $workDetails->save();

        $workDetails = ProjectWorkDetail::find($workDetails->uuid);

        return response()->json(['success' => 1, 'data' => $workDetails], 200);
    }

    public function saveWorkDetail()
    {
        $workDetails = request()->uuid ? ProjectWorkDetail::find(request()->uuid) : new ProjectWorkDetail();

        $workDetails->project_scope_uuid = request()->project_scope_uuid;
        $workDetails->detail = request()->detail;
        $workDetails->save();

        $workDetails = ProjectWorkDetail::find($workDetails->uuid);

        return response()->json(['success' => 1, 'rows' => $workDetails], 200);
    }

}
