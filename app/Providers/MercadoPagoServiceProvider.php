<?php

namespace App\Providers;

use App\Contracts\MercadoPagoRepository;
use App\Http\Controllers\JobOfferController;
use App\Repositories\MercadoPagoRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class MercadoPagoServiceProvider extends ServiceProvider{
    /**
     * Register services.
     */
    public function register(): void{
        $this->app->when(JobOfferController::class)
            ->needs(MercadoPagoRepository::class)
            ->give(MercadoPagoRepositoryImpl::class);

        $this->app->when(ScholarshipOfferController::class)
            ->needs(MercadoPagoRepository::class)
            ->give(MercadoPagoRepositoryImpl::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void{}
}
