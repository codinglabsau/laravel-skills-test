<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostCreateRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Image;


class PostController extends Controller
{
    public function create(Request $request) 
    {
        return view('home');
    }

    public function store(PostCreateRequest $request) 
    {
        $imgPath = "";
        if ($request->hasFile('image')) {
            // Create directory images if doesn't exist
            File::makeDirectory(public_path().'/images', 0755, true, true);
            // Avoid file names duplicated
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            // Just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Just file extension
            $extension = $request->file('image')->extension();
            // Name to Store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Full Path
            $imgPath = public_path().'/images/'.$fileNameToStore;
            //resize and store
            Image::make($request->file('image'))->resize(400, 300)->save($imgPath);
        } 

        $post = Post::create([
            'user_id'     => Auth::user()->id,
            'name'        => trim($request->name),
            'description' => trim($request->description),
            'image'       => $imgPath
        ]);

        if(isset($post)) {
            session()->flash('success', "The post '{$post->name}' has been created!");
        }

        return redirect(route('post.create'));
    }    
}
