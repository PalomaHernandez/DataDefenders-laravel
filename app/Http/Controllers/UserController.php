<?php

namespace App\Http\Controllers;

use App\Contracts\UserRepository;

class UserController extends Controller {

	public function __construct(private readonly UserRepository $userRepository){}

	public function index(){
		$user = auth()->user();
		if(request()->expectsJson()){
			return response()->json($user);
		}
		return view('users.index', compact('user'));
	}

	public function store(){
		$user = $this->userRepository->create();
		if(request()->expectsJson()){
			return response()->json($user);
		}
		return view('users.index', compact('user'));
	}

	public function edit(){
		$user = auth()->user();
		return view('users.edit', compact('user'));
	}

	public function update(int $userId){
		$user = $this->userRepository->update($userId);
		if(request()->expectsJson()){
			return response()->json($user);
		}
		return redirect()->route('users.index')->with([
			'success' => 'Your profile was updated successfully.'
		]);
	}
}


