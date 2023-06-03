<?php

namespace App\Providers;

use App\Contracts\UserRepository;
use App\Http\Controllers\UserController;
use App\Repositories\UserRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider {

	public function register():void{
		$this->app->when(UserController::class)
			->needs(UserRepository::class)
			->give(UserRepositoryImpl::class);
	}

	public function boot():void{
		//
	}

}
