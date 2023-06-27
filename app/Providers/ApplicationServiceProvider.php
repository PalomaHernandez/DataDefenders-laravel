<?php

namespace App\Providers;

use App\Contracts\ApplicationRepository;
use App\Contracts\MercadoPagoRepository;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\ScholarshipApplicationController;
use App\Repositories\AllApplicationRepository;
use App\Repositories\JobApplicationRepository;
use App\Repositories\MercadoPagoRepositoryImpl;
use App\Repositories\ScholarshipApplicationRepository;
use Illuminate\Support\ServiceProvider;

class ApplicationServiceProvider extends ServiceProvider {

	/**
	 * Register services.
	 */
	public function register():void{
		$this->app->when(ApplicationController::class)
			->needs(ApplicationRepository::class)
			->give(AllApplicationRepository::class);

		$this->app->when(JobApplicationController::class)
			->needs(ApplicationRepository::class)
			->give(JobApplicationRepository::class);

		$this->app->when(ScholarshipApplicationController::class)
			->needs(ApplicationRepository::class)
			->give(ScholarshipApplicationRepository::class);

		$this->app->when(MercadoPagoController::class)
			->needs(ApplicationRepository::class)
			->give(AllApplicationRepository::class);

		$this->app->when(MercadoPagoRepositoryImpl::class)
			->needs(ApplicationRepository::class)
			->give(AllApplicationRepository::class);
	}

	/**
	 * Bootstrap services.
	 */
	public function boot():void{}

}
