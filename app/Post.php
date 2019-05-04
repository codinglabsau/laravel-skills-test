<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['postid', 'id', 'name', 'description']; //allows single line filling
}
