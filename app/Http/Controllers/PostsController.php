<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class PostsController extends Controller
{
    //
    function addData(Request $req)
    {
        $post = new Post;
        $post->name=$req->name;
        $post->description=$req->description;
        $post->userID=$req->user()->id;
        $post->save();
        session()->flash('message', 'Post successfully updated.');
        return redirect('add');
        
    }
}
