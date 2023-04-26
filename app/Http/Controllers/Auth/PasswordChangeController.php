<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller
{
    function index(){
        $this->validateTokenRequest();
        $user = User::whereEmail(request('email'))->firstOrFail();
        if($user->password_recovery_token != request('token') || $user->password_recovery_starts_at <= now()){
            abort(403);
        }
        
        return view('auth.passwords.reset');
    }

    private function validateTokenRequest(){
        request()->validate([
            'email' => ['required','email'],
            'token' => ['required','string']
        ]);
    }

    function changePassword(){
        $this->validateChangeRequest();
        if(request('password') != request('password_confirmation')){
            return back()->with('error','The passwords must match.');
        }
        $user = User::whereEmail(request('email'))->firstOrFail();
        $user->password = Hash::make(request('password'));
        $user->save();
        return redirect()->route('login');
    }

    private function validateChangeRequest(){
        request()->validate([
            'email' => ['required','email'],
            'password' => ['required','string','confirmed']
        ]);
    }

}
