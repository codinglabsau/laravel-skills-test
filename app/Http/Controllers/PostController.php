<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Process and validate all incoming post request before saving to the database.
     * @param  Request $request An object coming from form.
     * @return {object}         An object data after saving.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
          'name' => 'required',
          'description' => 'required'
        ]);
        $user = $request->user();
        $post = new Post();
        $post->name = $request->get('name');
        $post->user_id = $user->id;
        $post->description = $request->get('description');
        $post->save();
        return redirect('/home')->with('success', "Voila! $post->name your post has been added.");
    }
}
