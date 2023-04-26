<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetLinkMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    function index(){
        return view('auth.passwords.email');
    }

    function sendResetLink(){
        $this->validateEmail();
        $user = User::whereEmail(request('email'))->firstOrFail();
        $token = Str::random(32);
        $user->update([
            'password_recovery_token' => $token,
            'password_recovery_expires_at' => now()->addMinute()
        ]);
        Mail::to($user->email)->send(
            new ResetLinkMail($user->first_name,route('reset.password',[
                'email' => $user->email,
                'token' => $token
            ]))
        );

        return redirect()->route('login')->with(['success'=>'The reset link has been sent to your email address.']);

    }

    protected function validateEmail(){
        request()->validate([
            'email' => ['required','email']
        ]);
    }



}
