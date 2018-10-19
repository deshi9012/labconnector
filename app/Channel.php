<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model {
    //
    protected $table = 'channels';

//    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function users() {
        return $this->belongsToMany('App\User', 'channel_users');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }
}
