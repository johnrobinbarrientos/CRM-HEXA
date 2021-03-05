<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ProjectScopeOfWork; 
use Illuminate\Support\Facades\Auth; 

class ProjectScopeOfWorkController extends Controller
{
    public function index($projectTypeUUID)
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
}