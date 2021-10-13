<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class LoginController extends Controller
{
	public function __construct() {
		$this->middleware('userguest');
	}


    public function login() {
    	$data = [];
		$data['menu_login'] = true;

		return view('login', $data);
	}


	public function submit(Request $request) {

		// if ajax request
		if($request->ajax()) {
			// dd($request);
			$rules = [
					'email'   => 'required|email',
					'password'   => 'required'
			];

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) {

				$errors = $validator->errors()->all();
				$data['type'] = 'error';
				$data['caption'] = 'One or more invalid input found.';
				$data['errorfields'] = $validator->errors()->keys();

			}
			else {

				$email = trim($request->email);
				$password = $request->password;
				$remember = 0;
				if($request->remember){
					$remember = 1;
				}


				if(Auth::guard('user')->validate(['email' => $email,'password' => $password])) {

					if(Auth::guard('user')->attempt(['email' => $email,'password' => $password], $remember)) {
						$data['type'] = 'success';
						$data['caption'] = 'Logged in successfully.';
						$data['redirectUrl'] = url('/');
					}
					else{
						$data['type'] = 'error';
						$data['caption'] = 'Your account has been deactivated.';
					}
				}
				else {
					$data['type'] = 'error';
					$data['caption'] = 'Invalid email address or password.';
				}

			}

			return response()->json($data);
		}
		else{
			return 'No direct access allowed!';
		}
	}

}
