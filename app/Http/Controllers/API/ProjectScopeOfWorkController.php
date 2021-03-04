<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ProjectScopeOfWork; 
use Illuminate\Support\Facades\Auth; 

class ProjectScopeOfWorkController extends Controller
{
    public function index($projectUUID)
    {
        $scopeOfWork = ProjectScopeOfWork::where('project_uuid','=',$projectUUID)->get();
        return response()->json(['success' => 1, 'rows' => $scopeOfWork], 200);
    }

    public function save($projectUUID)
    {
        $scopeOfWork = request()->uuid ? ProjectScopeOfWork::find(request()->uuid) : new ProjectScopeOfWork();

        $scopeOfWork->project_uuid = $projectUUID;
        $scopeOfWork->scope_of_work = request()->scope_of_work;
        $scopeOfWork->save();
        
        $scopeOfWork = ProjectScopeOfWork::find($scopeOfWork->uuid);

        return response()->json(['success' => 1, 'data' => $scopeOfWork], 200);
    }
}