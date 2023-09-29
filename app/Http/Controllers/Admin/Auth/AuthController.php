<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest:admin')->except('logout');
	}

	private $folder = "admin.";
	private $routeprefix = "admin.";

	public function showLogin()
	{
		return view('auth.login', [
			'form_url' => route('login'),
		]);
	}

	public function login(Request $request)
	{

		 

		$validate = Validator::make(
			$request->all(),
			[
				'email' => 'required|exists:admins',
				'password' => 'required'
			],
			[
				'email.exists' => "Email is not exists.",
				'email.required' => 'The Email is required.',
				'email.email' => 'Please enter valid email.',
			]
		);

		if ($validate->fails()) {
			return Redirect()->back()->with([
				'status' => false,
				'errors' => $validate->errors()
			]);
		}

		$attemps = session('logins') ?? 0;


		if (session('logins') == null) {
			$attemps = 1;
			Session::put('logins', 1);
		} else {
			$attemps += 1;
			Session::put('logins', $attemps);
		}

		if ($attemps >= 3) {
			return abort(401);
		}

		if (Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember_token'))) {
			Session::forget('logins');
			return redirect()->route('admin.dashboard');
		} else {
		}
		return Redirect()->back()->withErrors(['errors' => "Password doesn't match,Please try again."]);
	}

	public function getIpAddr()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ipAddr = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ipAddr = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ipAddr = $_SERVER['REMOTE_ADDR'];
		}
		return $ipAddr;
	}

	public function logout(Request $request)
	{
		Auth::guard()->logout();
		return redirect()->route('login')->withErrors(['msg' => 'Logout Successfuly.']);
	}
}
