<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\GlobalCustomerChannel; 
use Illuminate\Support\Facades\Auth; 

class GlobalCustomerChannelController extends Controller
{
    public function getCustomerChannels()
    {
        $list = GlobalCustomerChannel::whereNull('deleted_at');

        if (!empty(request()->keyword)) {
            $keyword = request()->keyword;
            $list = $list->where(function($query) use ($keyword) {
                $query->where('channel','LIKE','%'.$keyword.'%');
            });
        }

        $count = $list->count();

        // pagination
        $take = (is_numeric(request()->take) && request()->take <= 50) ? request()->take: 20;
        $page = (is_numeric(request()->page)) ? request()->page : 1;
        $offset = (($page - 1 ) * $take);

        $list = $list->take($take);
        $list = $list->offset($offset);
        $list = $list->get();

        return response()->json(['success' => 1, 'rows' => $list, 'count' => $count], 200);
    }

    public function save()
    {
        $channel = request()->uuid ? GlobalCustomerChannel::find(request()->uuid) : new GlobalCustomerChannel();
        $channel->channel = request()->channel;
        $channel->save();

        $channel = GlobalCustomerChannel::find($channel->uuid);

        return response()->json(['success' => 1, 'rows' => $channel], 200);
    }


    public function delete()
    {
        $channel = GlobalCustomerChannel::find(request()->uuid)->delete();
        return response()->json(['success' => 1, 'rows' => $channel], 200);
    }
}