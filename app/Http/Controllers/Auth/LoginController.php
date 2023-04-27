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

		return back()->withErrors([
			'email' => 'Wrong login details.',
			'password' => 'Wrong login details.'
		], 'login');
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
		return redirect()->route('home');
	}

}
