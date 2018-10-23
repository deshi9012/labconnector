<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('channel.{channelId}', function (App\User $user, $channelId) {

//    $user_all = $user->with('channels:channels.id,name')->first();
//    dd($user_all->channels);
    return true;

});
