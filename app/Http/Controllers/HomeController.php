<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use PhpParser\Node\Expr\PostDec;
use Illuminate\Http\Request;

use App\Posts;
use App\Http\Requests;
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


    public function post(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $dataPost = new Posts();
        $dataPost->name = $request->name;
        $dataPost->description = $request->description;
        $dataPost->user_id = Auth::id();

        $dataPost->save();
        $request->session()->flash('success',true);
        return view('home');
    }
}
