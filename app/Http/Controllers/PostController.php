<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Post;
use Image;

class PostController extends Controller
{
    public function createPost() {
        return view('home');
    }
    public function posts() {
        $posts = Post::all();
        return view('posts', ['posts' => $posts]);
    }

    public function create(Request $request, $user_id) {

        $request->validate(
            [
                'name' => 'required|max:20',
                'description' => 'required|max:255',
                'image' => 'required|mimes:jpg,png,jpeg|max:5048'
            ],
            [
                'name.max:20' => 'Reduce size of title',
                'password.max:255' => 'Reduce size of body'
            ]
        );

        $image = $request->file('image');
        //getClientOriginalName gets the name of the file, image.png
        $imageName = time() . '-' . $request->file('image')->getClientOriginalName();

        // setting the destination path of where the image is to be saved
        $desPath = public_path('/images');
        // makes the image to be resized
        $img = Image::make($image->path());
        $img->resize(400, 300, function ($constraint) {
            $constraint->aspectRatio();
        })->save($desPath.'/'.$imageName);

        $image->move($desPath, $imageName);


        $post = Post::create([
            'user_id' => request('user_id'),
            'name' => request('name'),
            'description' => request('description'),
            'image' => $imageName
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
