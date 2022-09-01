<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Image;

class PostController extends Controller{
 
    public function index(){

        $user = Auth()->user();
        $posts = $user->posts()->latest()->get();
   
        return view('dashboard',compact('posts'));
    }

    public function create(){
        //This is on dashboard page
    }

    public function store(StorePostRequest $request){

        $validated = $request->validated();

        $user = Auth()->user();

        //Image processing
        if(isset($request->image)){

            $image = $request->file('image');
            $imageName = time().".".$request->image->extension();
            $destinationPathThumbnail = public_path('/images');
            $img = Image::make($image->path());
            $img->resize(400, 300)->save($destinationPathThumbnail.'/'.$imageName);
            // $img->resize(400, 300, function ($constraint) {
            //     //$constraint->aspectRatio();
            // })->save($destinationPathThumbnail.'/'.$imageName);
         
            $validated['image'] = $imageName;
        }

       
        //Create post
        $post = new Post($validated);
 
        //Add to user
        $user->posts()->save($post);

        //Return success message
        $message = 'Successfully created "'.ucwords($post->name).'".';
        return back()->with('success', $message);
    }

    public function show(Post $post){ 

        return view('posts.view_post',compact('post'));
    }

    public function edit(Post $post){ 

        $user = Auth()->user();
        $posts = $user->posts()->latest()->get();
   
        return view('dashboard',compact('posts','post'));
    }

    public function update(StorePostRequest $request, Post $post){ 

        $validated = $request->validated();

        //Image processing
        if(isset($request->image)){

            $image = $request->file('image');
            $imageName = time().".".$request->image->extension();
            $destinationPathThumbnail = public_path('/images');
            $img = Image::make($image->path());
            $img->resize(400, 300)->save($destinationPathThumbnail.'/'.$imageName);
            // $img->resize(400, 300, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->save($destinationPathThumbnail.'/'.$imageName);
            
            $validated['image'] = $imageName;
        }

        $post->update($validated);

        //Return success message
        $message = 'Successfully updated "'.ucwords($post->name).'".';
        return back()->with('success', $message);
    }

    public function destroy(Post $post){
        
        //Confirm belongs to this user
        $user = Auth()->user();
        $post = $user->posts()->where('id',$post->id)->firstorfail();

        Post::destroy($post->id);

        //Return success message
        $message = 'Successfully deleted post';
        return redirect(route('dashboard'))->with('success_table', $message);
    }
}
