<?php

namespace App\Http\Controllers;

class UserController extends Controller {

	public function index(){
		return request()->user();
	}

	public function edit(){
		$user = auth()->user();
		return view('users.edit', compact('user'));
	}

	public function update(){
		auth()->user()->update(request()->validate([
			'first_name' => ['required', 'string'],
			'middle_name' => ['nullable', 'string'],
			'last_name' => ['required', 'string'],
		]));
		return back();
	}

}
