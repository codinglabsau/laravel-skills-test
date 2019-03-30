<?php

namespace App\Http\Controllers;

use App\Post;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\PostCheck;
class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * addPost function
     * Description: Add a post to the database  
     * @param object $request
     * @return redirect
     */
    public function addPost(PostCheck $request)
    {
    
        $post = new Post;

        $post->name = $request->name;
        $post->description = $request->description;
        $post->user_id = Auth::id();

        $post->save();
        
        return redirect('/home')->with('status', 'Your post has been submitted.');
    }

}
