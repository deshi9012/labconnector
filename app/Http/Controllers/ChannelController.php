<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller {
    //
    public function createChannel(Request $request) {
        $channel = Channel::create($request->all());
        return $channel;
    }

    public function getAllChannels() {
        $channels = Channel::where('users_mask',null)->get();
        dd($channels);
    }
}
