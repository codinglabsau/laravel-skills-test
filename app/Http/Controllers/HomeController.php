<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\post;

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
     * @return \Illuminate\Http\Response;
     */
    public function index()
    {

        return view('home');
    }

    public function save(Request $request)
    {
         //print_r($request->input());

         $post = new post;
         $post->userid ='1';
         $post->name = $request->name;
         $post-> description =$request->description;

         $post->save();

        

        echo  'Successfully Submitted';
    }

}