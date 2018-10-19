<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller {
    //
    public function createChannel(Request $request) {

        /*TODO
         * Make validations
         */
        $channel = Channel::create([
            'name' => $request->all()['channelName']
        ]);
        return $channel;
    }

    public function getAllChannels() {
        $channels = Channel::where('users_mask',null)->get();
        return $channels;
    }
}
