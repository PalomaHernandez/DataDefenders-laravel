<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller {

	public function index(){
		return view('auth.login');
	}

	public function attempt(){
		$this->validateLogin();

		if($this->attemptLogin()){
			return $this->sendLoginResponse();
		}

		if(request()->expectsJson()){
			return response()->json([
				'res' => false,
				'text' => 'We could not log you in.',
			]);
		}
		return back()->withErrors([
			'email' => 'Wrong login details.',
		]);
	}

	protected function validateLogin(){
		request()->validate([
			'email'    => 'required|email',
			'password' => 'required',
		]);
	}

	protected function attemptLogin(){
		return auth()->attempt($this->credentials());
	}

	protected function credentials(){
		return request()->only('email', 'password');
	}

	protected function sendLoginResponse(){
		request()->session()->regenerate();
		if(request()->expectsJson()){
			return response()->json([
				'res' => true,
				'text' => 'You have logged in successfully',
			]);
		}
		return redirect()->route('home');
	}

	public function logout(){
		auth()->logout();
		request()->session()->invalidate();
		request()->session()->regenerateToken();
		if($response = $this->loggedOut()){
			return $response;
		}
		abort(500);
	}

	protected function loggedOut(){
		if(request()->expectsJson()){
			return response()->json([
				'res' => true,
				'text' => 'You have been logged out successfully',
			]);
		}
		return redirect()->route('home');
	}

}
