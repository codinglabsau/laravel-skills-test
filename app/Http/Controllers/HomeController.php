<?php

namespace App\Http\Controllers;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use App\User;

use App\Post;

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

    public function create()
    {
        //
    }

    public function submit()
    {
        return view('formSubmitted');
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $desc = $request->input('description');

        $post = new Post;
        $post->name = $request->name;
        $post->description = $request->description;
        $post->save();
        
        //$user->notify(new FormSubmitted($form));
        //User::find(1)->notify(new FormSubmitted);
        


        
        return view('formSubmitted');
        //return "{{route('formSubmit')}}";

        //return " {{route('storeToHome')}} ";



        //return view('home');
        /*
        $arrayVals = array($name, $desc);
        print_r($arrayVals);
        */
        
    }
}
