<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\CompanyList;
use App\Models\ProjectList;
use Illuminate\Support\Facades\Auth; 

class ProjectListController extends Controller
{
    public function index()
    {
        $list = ProjectList::where('is_draft','=', 0)->whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('project_code','LIKE','%'.$keyword.'%')
                    ->orWhere('project_name','LIKE','%'.$keyword.'%')
                    ->orWhere('project_shortname','LIKE','%'.$keyword.'%');
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

        return response()->json(['success' => 1, 'rows' => $list, 'count' => $count], 200);
    }

    public function store() // initialize draft
    {
        $project =  ProjectList::where('is_draft','=', 1)->first();

        if (!$project) {

            $project = new ProjectList();

            $project->save();
        }


        $project = ProjectList::find($project->uuid);
        return response()->json(['success' => 1, 'data' => $project], 200);
    }

    public function update()
    {
        $project =  ProjectList::find(request()->uuid);
        
        if (!$project) {
            return response()->json(['success' => 0, 'data' => null, 'Not found'], 500);
        }

        $prefix = $this->getCompanyPrefix();
        $type = 'PR';
        $no_of_transactions = $this->getNumberOfTransactions(request()->uuid) + 1;
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $created_id = sprintf($type.'_'.$prefix.''.$year.''.$month.''.$day.'%05d',$no_of_transactions);
        
        //var_dump(request()->date_start);
        //die();
        
        $project->project_code = $created_id;
        $project->project_name = request()->project_name;
        $project->project_shortname = request()->project_shortname;
        $project->date_start = date('Y-m-d',strtotime(request()->date_start));
        
        if (request()->end_date == ''){
            $project->end_date = null;
        }else{
            $project->end_date = date('Y-m-d',strtotime(request()->end_date));
        }
        
        $project->cost = request()->cost;
        $project->is_draft = 0;
        $project->save();

        $project = ProjectList::find($project->uuid);
        return response()->json(['success' => 1, 'rows' => $project], 200);
    }

    public function show($projectUUID) // set update records
    {
        $project = ProjectList::find($projectUUID);

        if (!$project) {
            return response()->json(['success' => 0, 'data' => null, 'Not found'], 500);
        }
        return response()->json(['success' => 1, 'data' => $project], 200);
    }


    public function delete()
    {
        $project = ProjectList::find(request()->uuid)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }

    public function getCompanyPrefix()
    {
        $auth = \Auth::user();
        $prefix = CompanyList::whereNull('deleted_at')
        ->pluck('prefix')
        ->first();

        return $prefix;
    }

    public function getNumberOfTransactions($uuid)
    {
        $auth = \Auth::user();
        $no_of_transactions = ProjectList::whereNull('deleted_at')
        ->where('project_code','!=','')
        ->whereDate('created_at',date('Y-m-d'))->count();

        return $no_of_transactions;
    }

}