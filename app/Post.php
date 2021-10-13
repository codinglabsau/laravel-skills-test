<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    protected $table        = 'posts';

    protected $primaryKey   = 'post_id';


    protected $appends      = [
        'postdir',
        'imagefilepath',
        'hasimage'
    ];


    /*----------SETTER GETTER START----------*/
    public function getPostdirAttribute() {
        return config('constants.path_post') . intval($this->post_id) . '/';

    }

    public function getImagefilepathAttribute() {
        $imagefile = trim($this->imagefile);
        $post_id = intval($this->post_id);
        if(file_exists(public_path() . config('constants.path_post') . $post_id . '/' . $imagefile) && $imagefile != '') {
            return asset(config('constants.path_post') . $post_id . '/' . $imagefile);
        }
        else {
            return asset('images/no-images/page.png');
        }
    }

    public function getHasimageAttribute() {
        $imagefile = trim($this->imagefile);
        $post_id = intval($this->post_id);
        if(file_exists(public_path() . config('constants.path_post') . $post_id . '/' . $imagefile) && $imagefile != '') {
            return true;
        }
        return false;
    }
    /*----------SETTER GETTER END----------*/

    /*----------SOCPE FUNCTIONS START----------*/
    public function scopeSearch($query, $value) {
        if(!empty(trim($value))) {
            $value = trim($value);
            $query->where('posts.name', 'LIKE', '%'.$value.'%')
                  ->orWhere('posts.description', 'LIKE', '%'.$value.'%');
        }
        return $query;
    }

    /*----------SOCPE FUNCTIONS END----------*/
}
