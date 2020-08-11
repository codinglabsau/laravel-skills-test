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
    public function index(Request $request)
    {
        $pageSize = env('PAGE_SIZE', 15);

        // Normally This should be in the a reusable code. For Demo Purpose only
        $sort = key_exists('sort', $request->all()) ? $request->sort : 'created_at';
        $direction = key_exists('direction', $request->all()) ? $request->direction : 'asc';


        $user = Auth::user();
        $posts = $user->posts()->orderBy($sort, $direction)->paginate($pageSize);

        return view('home',
            compact('posts', 'user', 'sort', 'direction'));
    }
}
