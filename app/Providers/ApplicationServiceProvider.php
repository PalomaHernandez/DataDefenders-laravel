<?php

namespace App\Providers;

use App\Contracts\ApplicationRepository;
use App\Contracts\MercadoPagoRepository;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\ScholarshipApplicationController;
use App\Http\Controllers\ScholarshipOfferController;
use App\Repositories\ApplicationRepositoryImpl;
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
			->give(ApplicationRepositoryImpl::class);

		$this->app->when(JobOfferController::class)
			->needs(ApplicationRepository::class)
			->give(ApplicationRepositoryImpl::class);

		$this->app->when(ScholarshipOfferController::class)
			->needs(ApplicationRepository::class)
			->give(ApplicationRepositoryImpl::class);

		$this->app->when(JobApplicationController::class)
			->needs(ApplicationRepository::class)
			->give(JobApplicationRepository::class);

		$this->app->when(ScholarshipApplicationController::class)
			->needs(ApplicationRepository::class)
			->give(ScholarshipApplicationRepository::class);
	}

	/**
	 * Bootstrap services.
	 */
	public function boot():void{}

}
