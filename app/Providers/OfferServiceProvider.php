<?php

namespace App\Providers;

use App\Contracts\OfferRepository;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\ScholarshipOfferController;
use App\Repositories\JobOfferRepository;
use App\Repositories\ScholarshipOfferRepository;
use Illuminate\Support\ServiceProvider;

class OfferServiceProvider extends ServiceProvider {

	/**
	 * Register services.
	 */
	public function register():void{
		$this->app->when(JobOfferController::class)
			->needs(OfferRepository::class)
			->give(JobOfferRepository::class);

		$this->app->when(ScholarshipOfferController::class)
			->needs(OfferRepository::class)
			->give(ScholarshipOfferRepository::class);
	}

	/**
	 * Bootstrap services.
	 */
	public function boot():void{}

}
