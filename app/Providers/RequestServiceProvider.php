<?php

namespace App\Providers;

use App\Contracts\RequestRepository;
use App\Http\Controllers\JobRequestController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ScholarshipRequestController;
use App\Repositories\AllRequestRepository;
use App\Repositories\JobRequestRepository;
use App\Repositories\ScholarshipRequestRepository;
use Illuminate\Support\ServiceProvider;

class RequestServiceProvider extends ServiceProvider {

	/**
	 * Register services.
	 */
	public function register():void{
		$this->app->when(RequestController::class)
			->needs(RequestRepository::class)
			->give(AllRequestRepository::class);

		$this->app->when(JobRequestController::class)
			->needs(RequestRepository::class)
			->give(JobRequestRepository::class);

		$this->app->when(ScholarshipRequestController::class)
			->needs(RequestRepository::class)
			->give(ScholarshipRequestRepository::class);
	}

	/**
	 * Bootstrap services.
	 */
	public function boot():void{}

}
