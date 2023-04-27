<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller {

	function index(){
		$this->validateTokenRequest();
		if($this->checkTokenValidity()){
			abort(403);
		}
		return view('auth.passwords.reset');
	}

	private function validateTokenRequest(){
		request()->validate([
			'email' => ['required', 'email'],
			'token' => ['required', 'string']
		]);
	}

	private function checkTokenValidity(){
		$user = User::whereEmail(request('email'))->firstOrFail();
		return $user->password_recovery_token != request('token') || $user->password_recovery_starts_at <= now();
	}

	function changePassword(){
		$this->validateChangeRequest();
		if($this->checkNewPassword()){
			return back()->withErrors([
				'password'              => 'The passwords must match.',
				'password_confirmation' => 'The passwords must match.'
			], 'password.reset');
		}
		$user = User::whereEmail(request('email'))->firstOrFail();
		$user->update([
			'password'                    => Hash::make(request('password')),
			'password_recovery_token'     => null,
			'password_recovery_starts_at' => null,
		]);
		return redirect()->route('login');
	}

	private function checkNewPassword(){
		return request('password') != request('password_confirmation');
	}

	private function validateChangeRequest(){
		request()->validate([
			'email'    => ['required', 'email'],
			'password' => ['required', 'string', 'confirmed']
		]);
	}

}
