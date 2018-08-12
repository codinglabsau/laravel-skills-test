<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePost;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function store(StorePost $request)
    {
      // basic server-side validation
      // Client wanted to use Form Request Validation instead.

       // $request->validate([
       //   'name' => 'required|max:200|string',
       //   'description' => 'required|string'
       // ]);

      //store to db
      $post = new Post;
      $post->name = $request->name;
      $post->description = $request->description;
      $post->user_id = Auth::user()->id;
      $post->save();

      //Send a flash message for this request
      Session::flash('success','The post was successfully saved!');

      // redirect to back to homepage
      return redirect()->route('home',$post->id);

    }

}
