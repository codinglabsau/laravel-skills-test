<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class PostsController extends Controller
{
    //
    function addData(Request $req)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ], [
            'name.required' => 'Name is required',
            'description.required' => 'Description is required'
        ]);
        $post = new Post;
        $post->name=$req->name;
        $post->description=$req->description;
        $post->userID=$req->user()->id;
        $post->save();
        session()->flash('message', 'Post successfully updated.');
        return redirect('add');
        
    }
}
