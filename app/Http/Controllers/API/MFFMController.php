<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\MFFMBenchmark; 
use App\Models\MFFMProspect; 
use Illuminate\Support\Facades\Auth; 

class MFFMController extends Controller
{
    public function storeProspect()
    {
        $auth = \Auth::user();
        $prospect = new MFFMProspect();
        $prospect->uuid = \Uuid::generate(4);
        $prospect->company_id = $auth->company_id;
        $prospect->user_id = $auth->id;
        $prospect->mffm_benchmark_id = request()->benchmark_id;
        $prospect->prospect = request()->prospect;
        $prospect->save();
        
        // to prevent stupid error
        $prospect = MFFMProspect::find($prospect->id);

        return response()->json(['success' => 1, 'data' => $prospect, 'message' => 'User Added!'], 200); 
    }

    public function benchmarks()
    {
        $user = \Auth::user();
        $benchmarks = MFFMBenchmark::where('company_id','=',$user->company_id)->get();

        return response()->json(['success' => 1, 'rows' => $benchmarks], 200); 
    }

    public function benchmarkShow($id) 
    {
        $benchmark = MFFMBenchmark::find($id);
        
        if ($benchmark) {
            $prospects = MFFMProspect::where('mffm_benchmark_id','=',$benchmark->id)->get();
            $benchmark->prospects = $prospects;
        }
        return response()->json(['success' => 1, 'data' => $benchmark], 200); 
    }

    public function storeBenchmark()
    {
        $auth = \Auth::user();

        $benchmark = new MFFMBenchmark();
        $benchmark->uuid = \Uuid::generate(4);
        $benchmark->company_id = $auth->company_id;
        $benchmark->user_id = $auth->id;
        $benchmark->title = request()->title;
        $benchmark->prospect_to_mql = request()->prospect_to_mql;
        $benchmark->mql_to_sal = request()->mql_to_sal;
        $benchmark->sal_to_sqo = request()->sal_to_sqo;
        $benchmark->sql_to_close = request()->sql_to_close;
        $benchmark->average_deal_size = request()->average_deal_size;
        $benchmark->save();
        
        // to prevent stupid error
        $benchmark = MFFMBenchmark::find($benchmark->uuid);
        
        return response()->json(['success' => 1, 'data' => $benchmark, 'message' => 'Benchmark Added!'], 200); 
    }
}
