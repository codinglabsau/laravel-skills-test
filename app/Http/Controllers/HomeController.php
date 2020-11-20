<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Post, User};
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard and all user posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get user id
        $user_id = Auth::user()->id;

        //Find all user's posts
        $posts = Post::where('user_id', $user_id)->get();

        //Return view, populated with posts.
        return view('home')->with('posts', $posts);
    }

    /**
     * Store a newly created post (and associated image, if provided) in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //Validate fields according to rules
      $this->validate($request, [
          'name' => 'required|string',
          'description' => 'required|string',
          'image' => 'nullable|file|mimes:png,jpeg,jpg,tiff,tif|max:512' //500KB seems an appropriate limit for an eventual 400x300px image
      ]);

      //Create post and assign validated parameters and user id
      $post = new Post();
      $post->user_id = Auth::user()->id;
      $post->name = $request->name;
      $post->description = $request->description;

      //If a file has been uploaded and is valid according to validation
      if($request->hasFile('image') && $request->file('image')->isValid()) {
          //Get raw image
          $rawImage = $request->file('image');

          //Create filename by appending correct extension to new UUID
          $filename = Str::uuid().'.'.$rawImage->getClientOriginalExtension();
          $fullPath = public_path('storage/post-images/'.$filename);

          /*
            Create resized image, without maintaining aspect ratio.

            It's possible to resize maintaining aspect ratio using a callback.

              public function resize (integer $width, integer $height, [Closure $callback])

            See http://image.intervention.io/api/resize for more.
          */
          $resizedImage = Image::make($rawImage)->resize(400, 300);

          //Save image
          $resizedImage->save($fullPath);

          //Set image_path record attribute to generated filenamme
          $post->image_path = $filename;
      }

      //Save the post
      $post->save();

      //Redirect home with creation success status
      return redirect()->action('HomeController@index')->with('status', 'Success! Your post has been made.');
    }

    /**
     * Remove the specified post (and associated image, if applicable) from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //Find post by id.
        $post = Post::findOrFail($id);
        $existingImage = $post->image_path;

        //Delete image from storage, if a path for it exists
        if ($existingImage) {
          Storage::delete('public/post-images/'.$existingImage);
        }

        //Delete the post
        $post->delete();

        //Redirect home with deletion success status
        return redirect()->action('HomeController@index')->with('status', 'Success! Your post has been deleted.');
    }
}
