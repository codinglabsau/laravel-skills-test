<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        return view('home', ['posts' => $posts]);
    }


    public function store(FormPostRequest $request)
    {
        $attributes = $request->validated();

        $attributes['user_id'] = $request->user()->id;
        //check if there was an image saved and how to handle if it was
        if (isset($attributes['image_path'])) {
            $imageName = time() . '-' . $request->input(
                    'name'
                ) . '-' . $attributes['image_path']->getClientOriginalName();
            $newImage = $attributes['image_path'];
            $testImage = Image::make($newImage->getRealpath())->resize(400, 300);
            $testImage->save(public_path('uploads/' . $imageName));
            $attributes['image_path'] = "uploads/$imageName";
        }


        Post::create($attributes);
        return redirect('/home')->with('message', 'You have Successfully created a New Post');
    }

}
