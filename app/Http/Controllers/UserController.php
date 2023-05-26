<?php

namespace App\Http\Controllers;
use App\Models\User;

class UserController extends Controller {

	public function index(){
		$user = auth()->user();
		return view('users.index', compact('user'));
	}

	public function edit(){
		$user = auth()->user();
		return view('users.edit', compact('user'));
	}

	public function update(User $user){
		$user->update(request()->validate([
			'first_name' => ['string', 'required', 'max:255'],
			'middle_name' => ['string', 'nullable', 'max:255'],
			'last_name' => ['string', 'required', 'max:255'],
			'phone' => ['string', 'required', 'max:20'],
			'address_line_1' => ['string', 'required', 'max:255'],
			'address_line_2' => ['string', 'nullable', 'max:255'],
			'city' => ['string', 'required', 'max:255'],
			'region' => ['string', 'required', 'max:255'],
			'country' => ['string', 'required', 'max:255'],
			'postal_code' => ['string', 'required', 'max:10'],
			'id_card' => ['string', 'required', 'max:20'],
		]));
		return redirect()->route('users.index')->with([
			'success' => 'Your profile was updated successfully.'
		]);
	}
}


