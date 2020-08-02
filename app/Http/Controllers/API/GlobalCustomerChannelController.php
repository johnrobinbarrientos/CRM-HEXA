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
        $channel = GlobalCustomerChannel::whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $channel], 200);
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