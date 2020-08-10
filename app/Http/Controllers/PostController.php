<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }

    public function create()
    {
        return view('home');
    }

    public function store(PostRequest $request)
    {

        $request->validated();

        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->name = $request->input('name');
        $post->description = $request->input('description');
        $post->save();

        return back()->with('message', 'Your post has been submitted!');
    }
}
