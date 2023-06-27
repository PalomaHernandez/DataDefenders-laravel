<?php

namespace App\Providers;

use App\Contracts\UserRepository;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\UserController;
use App\Repositories\ApplicationRepositoryImpl;
use App\Repositories\JobApplicationRepository;
use App\Repositories\JobOfferRepository;
use App\Repositories\ScholarshipApplicationRepository;
use App\Repositories\ScholarshipOfferRepository;
use App\Repositories\UserRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider {

	public function register():void{
		$this->app->when(UserController::class)
			->needs(UserRepository::class)
			->give(UserRepositoryImpl::class);

		$this->app->when(ApplicationRepositoryImpl::class)
			->needs(UserRepository::class)
			->give(UserRepositoryImpl::class);

		$this->app->when(JobApplicationRepository::class)
			->needs(UserRepository::class)
			->give(UserRepositoryImpl::class);

		$this->app->when(ScholarshipApplicationRepository::class)
			->needs(UserRepository::class)
			->give(UserRepositoryImpl::class);

		$this->app->when(MercadoPagoController::class)
			->needs(UserRepository::class)
			->give(UserRepositoryImpl::class);

		$this->app->when(JobOfferRepository::class)
			->needs(UserRepository::class)
			->give(UserRepositoryImpl::class);

		$this->app->when(ScholarshipOfferRepository::class)
			->needs(UserRepository::class)
			->give(UserRepositoryImpl::class);
	}

	public function boot():void{
		//
	}

}
