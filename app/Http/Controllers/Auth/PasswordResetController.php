<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetLinkMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller {

	function index(){
		return view('auth.passwords.email');
	}

	function sendResetLink(){
		$user = $this->getUser();
		if(is_null($user)){
			return $this->sendResponse();
		}
		$token = Str::random(32);
		$user->update([
			'password_recovery_token'      => $token,
			'password_recovery_expires_at' => now()->addMinutes(15)
		]);
		$resetLink = route('password.reset', [
			'email' => $user->email,
			'token' => $token
		]);
		$email = new ResetLinkMail($user->first_name, $resetLink);
		Mail::to($user->email)->send($email);
		return $this->sendResponse();
	}

	private function getUser(){
		$this->validateEmail();
		return User::whereEmail(request('email'))->first();
	}

	private function validateEmail(){
		request()->validate([
			'email' => ['required', 'email']
		]);
	}

	private function sendResponse(){
		return redirect()->route('login')->with([
			'success' => 'The reset link has been sent to your e-mail address.'
		]);
	}

}
