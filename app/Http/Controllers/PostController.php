<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function store(Request $request)
    {

      $validatedData = $request->validate([
          'name' => 'required',
          'description' => 'required'
      ]);

      $user = auth()->user();
      $post = new Post();
      $post->name = $request->get('name');
      $post->user_id = $user->id;
      $post->description = $request->get('description');
      $post->save();

      return redirect('/home')->with('success', "Voila! $post->name your post has been added.");

    }
}
