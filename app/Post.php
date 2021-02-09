<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    function user() {
        return $this->belongsTo('App\User');
    }
}
