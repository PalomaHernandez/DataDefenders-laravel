<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;



class LoginController extends Controller{
    
    function index(){
        return view('auth.login');
    }
    
    function checklogin(){
        
        $this->validateLogin();
       
        if($this->attemptLogin()){
            return $this->sendLoginResponse();
        } 

        return back()->with('error','Wrong login details'); 
    }

    protected function validateLogin(){
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }

    protected function attemptLogin(){
        return auth()->attempt(
            $this->credentials()
        );
    }

    protected function credentials(){
        return request()->only('email','password');
    }

    protected function sendLoginResponse(){
        request()->session()->regenerate();

        if ($response = $this->authenticated()) {
            return $response;
        }
    }

    protected function authenticated(){
        return redirect()->route('home');
    }

    public function logout(){
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        if ($response = $this->loggedOut()) {
            return $response;
        }
    }

    protected function loggedOut(){
        return redirect()->route('home');
    }

}
