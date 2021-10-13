<?php namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\BaseController;

class PostbaseController extends BaseController {

    public function __construct() {

    	Parent::__construct();

    	$this->middleware('userauth');

    }

}