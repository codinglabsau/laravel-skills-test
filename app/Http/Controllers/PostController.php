<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostController extends Controller
{ 
    public function createPost(Request $request)
    {
        $post = new Post;        
        $post->user_id = Auth::user()->id;
        $post->name = $request->name;
        $post->description = $request->description; 
        $post->save();

        return redirect()->back()->with('success', 'Post created successfully.');
    }
}
