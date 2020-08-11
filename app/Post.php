<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getShortenAttribute()
    {
        $limit = env('APP_SHORTEN_LIMIT', 40);

        return str_limit($this->description, $limit, $end = '...');
    }

    public function getCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
