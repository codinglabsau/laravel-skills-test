<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Image;

class PostController extends BaseController
{
    const RESIZE_FILE_WIDTH = 400;
    const RESIZE_FILE_HEIGHT = 300;

    public function create(Request $request)
    {
        return view('home');
    }

    public function store(PostCreateRequest $request)
    {
        try {
            $imagePath = "";
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imagePath = '/uploads/' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . date('mdhis') . '.' . $file->getClientOriginalExtension();
                Image::make($request->file('image'))->resize($this::RESIZE_FILE_WIDTH, $this::RESIZE_FILE_HEIGHT)->save(public_path() . $imagePath);
            }
            $post = Post::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'description' => $request->description,
                'image_path' => $imagePath
            ]);
        } catch (QueryException $e) {
            session()->flash('exception', "Error has occured.");
        }

        session()->flash('success', "Post #{$post->id} was successfully created");

        return redirect(route('post.create'));
    }
}
