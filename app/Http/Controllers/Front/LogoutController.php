<?php namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Front\BaseController;

class LogoutController extends BaseController {

	public function logout(){
		Auth::guard('user')->logout();
		return redirect('/');
	}

}

