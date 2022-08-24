<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Post;

class PostController extends Controller
{
    public function posts() {
        $posts = Post::all();
        return view('posts', ['posts' => $posts]);
    }

    public function create($user_id) {
        request()->validate([
            'name' => 'required|max:25',
            'description' => 'required|max:255',
        ]);
        // $validator->errors()->add('start', 'Start date must be later than end date');

        $post = Post::create([
            'user_id' => $user_id,
            'name' => request('name'),
            'description' => request('description')
        ]);
        $result = $post->save();
        if ($result) {
            $color = "text-green-400";
            $message = 'Post created successfully';
        } else {
            $color = "text-red-400";
            $message = 'Failed to create post!';
        }
        session()->flash('message', $message);
        session()->flash('colour', $color);
        return redirect("/");
    }
}
