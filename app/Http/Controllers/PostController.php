<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();

        $post->user_id = Auth::user()->id;
        $post->name = $request->input('name');
        $post->description = $request->input('description');

        $post->save();
        $request->session()->flash('alert-success', 'Post was successfully added!');
        return redirect()->back();

    }
}
