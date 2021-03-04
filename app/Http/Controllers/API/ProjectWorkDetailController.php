<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ProjectWorkDetail; 
use Illuminate\Support\Facades\Auth; 

class ProjectWorkDetailController extends Controller
{
    public function index($projectscopeUUID)
    {
        $workDetails = ProjectWorkDetail::where('project_scope_uuid','=',$projectscopeUUID)->get();
        return response()->json(['success' => 1, 'rows' => $workDetails], 200);
    }

    public function save($projectscopeUUID)
    {
        $workDetails = request()->uuid ? ProjectWorkDetail::find(request()->uuid) : new ProjectWorkDetail();

        $workDetails->project_scope_uuid = $projectscopeUUID;
        $workDetails->detail = request()->detail;
        $workDetails->save();

        $workDetails = ProjectWorkDetail::find($workDetails->uuid);

        return response()->json(['success' => 1, 'data' => $workDetails], 200);
    }

}
