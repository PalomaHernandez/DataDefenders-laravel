<?php

namespace App\Providers;

use App\Contracts\MercadoPagoRepository;
use App\Repositories\ApplicationRepositoryImpl;
use App\Repositories\JobApplicationRepository;
use App\Repositories\MercadoPagoRepositoryImpl;
use App\Repositories\ScholarshipApplicationRepository;
use Illuminate\Support\ServiceProvider;

class MercadoPagoServiceProvider extends ServiceProvider {

	/**
	 * Register services.
	 */
	public function register():void{
		$this->app->when(ApplicationRepositoryImpl::class)
			->needs(MercadoPagoRepository::class)
			->give(MercadoPagoRepositoryImpl::class);

		$this->app->when(JobApplicationRepository::class)
			->needs(MercadoPagoRepository::class)
			->give(MercadoPagoRepositoryImpl::class);

		$this->app->when(ScholarshipApplicationRepository::class)
			->needs(MercadoPagoRepository::class)
			->give(MercadoPagoRepositoryImpl::class);
	}

	/**
	 * Bootstrap services.
	 */
	public function boot():void{}

}
