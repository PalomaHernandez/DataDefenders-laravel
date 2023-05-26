<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PasswordChangeController extends Controller {

	public function index(){
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
		return $user->password_recovery_token != request('token') || $user->password_recovery_expires_at <= now();
	}

	public function changePassword(){
		$this->validateChangeRequest();
		if($this->checkNewPassword()){
			throw ValidationException::withMessages([
				'password'              => 'The passwords must match.',
				'password_confirmation' => 'The passwords must match.'
			]);
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
