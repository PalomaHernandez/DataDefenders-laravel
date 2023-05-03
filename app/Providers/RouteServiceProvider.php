<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * The path to the "home" route for your application.
	 *
	 * Typically, users are redirected here after authentication.
	 *
	 * @var string
	 */
	public const HOME = '/home';

	/**
	 * Define your route model bindings, pattern filters, and other route configuration.
	 */
	public function boot():void{
		$this->configureRateLimiting();

		$this->routes(function (){
			Route::middleware(['api', 'auth:sanctum'])->group(function (){
				Route::prefix('api')->group(function (){
					Route::prefix('account')->group(base_path('routes/api/account.php'));
					Route::prefix('departments')->group(base_path('routes/api/departments.php'));
					Route::prefix('majors')->group(base_path('routes/api/majors.php'));
					Route::prefix('reports')->group(base_path('routes/api/reports.php'));
					Route::prefix('requests')->group(base_path('routes/api/requests/index.php'));
					Route::prefix('requests/job')->group(base_path('routes/api/requests/job/index.php'));
					Route::prefix('requests/scholarship')->group(base_path('routes/api/requests/scholarship/index.php'));
					Route::prefix('offers/job')->group(base_path('routes/api/offers/job.php'));
					Route::prefix('offers/scholarship')->group(base_path('routes/api/offers/scholarship.php'));
				});
			});

			Route::middleware('web')->group(base_path('routes/web.php'));
		});
	}

	/**
	 * Configure the rate limiters for the application.
	 */
	protected function configureRateLimiting():void{
		RateLimiter::for('api', function (Request $request){
			return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
		});
	}

}
