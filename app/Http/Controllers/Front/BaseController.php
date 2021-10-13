<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use View;
use App\User;

class BaseController extends Controller
{
    protected $globaldata = [];

    public function __construct() {

    	if(Auth::guard('user')->check()) {
    		$user = Auth::guard('user')->user();
    		$this->globaldata['user'] = $user;
    		// dd($this->globaldata['user']);
    		View::share('globaldata', $this->globaldata);
    	}
    }
}
