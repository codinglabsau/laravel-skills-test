<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Controllers\Controller;
use App\Rules\FullNameRule;
use Image;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PostController extends BaseController
{
   
    public function store(Request $request)
    {
        //dd($request->all());

        $validated = $request->validate([
            'name' => ['required',new FullNameRule],
            'description' => ['required','max:255'],
            'image' => ['image','max:2048']]);
        //dd($validated['name']);

        $post = new Post();
        $post->name = $validated['name'];
        $post->description= $validated['description'];
        $post->userid = Auth::id();
    
        
        if ($request->hasFile('image')) {
  
            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('Image');
            $img = Image::make($image->getRealPath());
            $img->resize(400, 300, function ($constraint) {
            $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
            
            $post->image = $input['imagename'];
            }
        $post->save();

        return redirect()->back()->with('message', 'Post was successful');
    }

   

}
