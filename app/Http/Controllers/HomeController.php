<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $pageSize = env('PAGE_SIZE', 15);

        $user = Auth::user();
        $posts = $user->posts()->orderBy('created-at', 'asc')->paginate($pageSize);

        return view('home', compact('posts', 'user'));
    }
}
