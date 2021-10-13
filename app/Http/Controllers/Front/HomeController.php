<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\BaseController;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function index() {
    	if(!isset($this->globaldata['user'])){
			return view('welcome');
    	}
    	else {
    		return redirect()->to('posts');
    	}
	}
}
