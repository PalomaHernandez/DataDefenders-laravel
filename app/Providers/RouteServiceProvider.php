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
	public const HOME = '/';

	/**
	 * Define your route model bindings, pattern filters, and other route configuration.
	 */
	public function boot():void{
		$this->configureRateLimiting();

		$this->routes(function (){
			Route::middleware(['api', 'auth:sanctum'])->group(function (){
				Route::prefix('api')->group(function (){
					Route::prefix('account')->group(base_path('routes/api/account/index.php'));
					Route::prefix('departments')->group(base_path('routes/api/departments.php'));
					Route::prefix('majors')->group(base_path('routes/api/majors.php'));
					Route::prefix('reports')->group(base_path('routes/api/reports.php'));
					Route::prefix('applications')->group(base_path('routes/api/applications/index.php'));
					Route::prefix('applications/files')->group(base_path('routes/api/applications/files.php'));
					Route::prefix('applications/job')->group(base_path('routes/api/applications/job/index.php'));
					Route::prefix('applications/scholarship')->group(base_path('routes/api/applications/scholarship/index.php'));
					Route::prefix('offers/job')->group(base_path('routes/api/offers/job.php'));
					Route::prefix('offers/scholarship')->group(base_path('routes/api/offers/scholarship.php'));
				});
			});

			Route::middleware('web')->group(function(){
				Route::prefix('api')->group(base_path('routes/api/account/auth.php'));
				Route::middleware('guest')->group(base_path('routes/web/account/login.php'));
				Route::prefix('')->group(base_path('routes/web/account/recovery.php'));
				Route::middleware('auth')->group(function (){
					Route::prefix('')->group(base_path('routes/web/home.php'));
					Route::prefix('')->group(base_path('routes/web/account/logout.php'));
					Route::prefix('my-account')->group(base_path('routes/web/account/index.php'));
					Route::prefix('admin/departments')->group(base_path('routes/web/admin/departments.php'));
					Route::prefix('admin/majors')->group(base_path('routes/web/admin/majors.php'));
					Route::prefix('admin/applications')->group(base_path('routes/web/admin/applications/index.php'));
					Route::prefix('admin/applications/job')->group(base_path('routes/web/admin/applications/jobs/index.php'));
					Route::prefix('admin/applications/scholarship')->group(base_path('routes/web/admin/applications/scholarships/index.php'));
					Route::prefix('admin/offers/job')->group(base_path('routes/web/admin/offers/job.php'));
					Route::prefix('admin/offers/scholarship')->group(base_path('routes/web/admin/offers/scholarship.php'));
				});
			});
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
