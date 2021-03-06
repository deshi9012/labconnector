<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {
    //
    protected $table = 'messages';

    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function channel() {
        return $this->belongsTo('App\Channel');
    }
}
