<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller {
    //
    public function createMessage(Request $request) {
        /*TODO make validation
         * */

        $channelId = $request->all()['channelId'];

        $userId = $request->all()['userId'];
        $message = $request->all()['message'];
        $message = Message::create([
            'channel_id' => $channelId,
            'user_id'    => $userId,
            'message'   => $message
        ]);

        NewMessage::dispatch($userId, $message, $channelId);

    }
}
