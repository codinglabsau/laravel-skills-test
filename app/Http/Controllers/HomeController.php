<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

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

    public function store(Request $request)
    {
        dd('request', $request);
        $this->validate($request, [
            'name' => 'required|unique:posts,name',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->name = $request->name;
        $post->description = $request->description;
        $post->save();
        return redirect('home')->with('status', 'Post Created Successfully!');
    }
}
