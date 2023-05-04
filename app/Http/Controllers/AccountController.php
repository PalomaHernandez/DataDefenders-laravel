<?php

namespace App\Http\Controllers;

class AccountController extends Controller {

	public function index(){
		return request()->user();
	}

	public function update(){
		return request()->user()->update(request()->validate([
			'first_name' => ['string', 'required', 'max:255'],
			'middle_name' => ['string', 'nullable', 'max:255'],
			'last_name' => ['string', 'required', 'max:255'],
			'email' => ['email', 'required', 'max:255'],
			'phone' => ['string', 'required', 'max:20'],
			'address_line_1' => ['string', 'required', 'max:255'],
			'address_line_2' => ['string', 'nullable', 'max:255'],
			'city' => ['string', 'required', 'max:255'],
			'region' => ['string', 'required', 'max:255'],
			'country' => ['string', 'required', 'max:255'],
			'postal_code' => ['string', 'required', 'max:10'],
			'id_card' => ['string', 'required', 'max:20'],
		]));
	}

}
