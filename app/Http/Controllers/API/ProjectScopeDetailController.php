<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\ProjectScopeDetail;
use Illuminate\Support\Facades\Auth; 

class ProjectScopeDetailController extends Controller
{
    public function index()
    {
        $list = ProjectScopeDetail::whereNull('deleted_at');

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
        $workDetails = ProjectScopeDetail::where('project_scope_uuid','=',$projectscopeUUID)->get();
        return response()->json(['success' => 1, 'rows' => $workDetails], 200);
    }

    static public function save($project_scope_uuid,$scope_details)
    {

        $details_uuids = [];
        
        foreach ($scope_details as $key => $detail) {
            if ( is_null($detail['uuid'])) {
                continue;
            }
            $details_uuids[] = $detail['uuid'];
        }

        // delete details
        ProjectScopeDetail::where('project_scope_uuid','=',$project_scope_uuid)->whereNotIn('uuid',$details_uuids)->delete();

        foreach ($scope_details as $key => $detail) {

            $uuid = $detail['uuid'];
            $detail = $detail['detail'];
            
            if (isset($detail['deleted_at']) == false){
                $data = ProjectScopeDetail::where('uuid','=',$uuid)->first();
                $data = ($data) ? $data : new  ProjectScopeDetail;
                $data->project_scope_uuid = $project_scope_uuid;
                $data->detail = $detail;
                $data->save();
            }
            else {
                $data = ProjectScopeDetail::find($uuid)->delete(); 
            }

        }

    }


}
