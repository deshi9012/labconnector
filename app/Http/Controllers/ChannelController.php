<?php

namespace App\Http\Controllers;

use App\Channel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $channels = Channel::where('users_mask', null)->get();
        return $channels;
    }

    public function joinChannel($channelId) {
        $user = User::first(Auth::user()->id);
        dd($user);

    }

    public function channelMessages($id) {
        if($this->checkJoined($id)) {
            return $channelMessages = Channel::with('messages.user')->find($id);
        }else {
            return response()->json(['errorMessage' => 'You are not joined']
                , 401);
        }

    }
    private function checkJoined($channelId) {

        $userId = Auth::user()->id;

        $data = User::with('channels:channels.id')->find($userId);
        foreach ($data->channels as $item) {
            if ($item->id == $channelId) {
                //the user is joined to this channel
                return true;
            }
        }
        //the user is not joined to this channel
        return false;
    }
}
