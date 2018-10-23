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

        $user = User::find(Auth::user()->id);

        $channel = Channel::find($channelId);
        $channel->users()->save($user);
        return $channel;
    }

    public function channelMessages($id) {
        if ($this->checkJoined($id)) {
            return $channelMessages = Channel::with('messages.user')->find($id);
        } else {
            return response()->json(['errorMessage' => 'You are not joined'], 401);
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

    public function checkUsersMask(Request $request) {
        $id1 = Auth::user()->id;
        $id2 = $request->all()['userId'];
        $channel = Channel::with('messages.user')->where('users_mask', $id1 . '_' . $id2)->orWhere('users_mask', $id2 . '_' . $id1)->first();
        if(!$channel){

            $user1 = User::find($id1);
            $user2 = User::find($id2);
            $channel = Channel::create(['users_mask' => $id1 . '_' . $id2 ]);
            $channel->users()->save($user1);
            $channel->users()->save($user2);

        }
        return $channel;
    }
}
