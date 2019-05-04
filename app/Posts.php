<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable = [
       'id', 'user_id', 'name','description'
    ];
}
