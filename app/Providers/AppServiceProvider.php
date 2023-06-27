<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Register any application services.
	 */
	public function register():void{
		$this->app->register(ApplicationServiceProvider::class);
		$this->app->register(UserServiceProvider::class);
		$this->app->register(MercadoPagoServiceProvider::class);
		$this->app->register(OfferServiceProvider::class);
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot():void{}

}
