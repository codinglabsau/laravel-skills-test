<?php namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Response as Res;

class AuthenticateUser {

	protected $auth;

	public function __construct() {

		$this->auth = Auth::guard('user');

	}

	public function handle($request, Closure $next)	{

		$globaldata = [];

		// USER SESSION NOT SET
		if ($this->auth->guest()) {

			// AJAX REQUEST
			if($request->ajax()) {
				$data = [];
				$data['type'] = 'error';
				$data['caption'] = 'Unauthorized access.';
				$data['redirectUrl'] = url('/');
				return response()->json($data);

			}
			// NON AJAX REQUEST
			else {
				return redirect()->guest('/');
			}

		}

		return $next($request);
	}

}