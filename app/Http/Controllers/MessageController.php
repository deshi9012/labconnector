<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Message;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller {
    //
    public function createMessage(Request $request) {
        /*TODO make validation
         * */

        $channelId = $request->all()['channelId'];

        $userId = $request->all()['userId'];
        $user = User::with('channels')->find($userId);

        $joinedChannels = [];

        foreach ($user->channels as $channel) {
            $joinedChannels[] = $channel->id ;
        }

        $name = $request->all()['name'];

        $message = $request->all()['message'];
        $message = Message::create([
            'channel_id' => $channelId,
            'user_id'    => $userId,
            'message'   => $message
        ]);

        NewMessage::dispatch($userId, $name, $message, $channelId);

    }
}
