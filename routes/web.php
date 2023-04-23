<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\ScholarshipOfferController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
	// TODO: Paloma -> show login form
	return view('auth.login');
})->name('login');

Route::post('/login', function () {
	// TODO: Paloma -> fully implement login
	if(auth()->attempt(request()->only(['email', 'password']))){
		return redirect()->intended();
	}
	return back()->withInput()->with(['error' => 'Failed']);
})->name('login');

Route::get('/logout', function () {
	// TODO: Paloma -> fully implement logout
	auth()->logout();
	return redirect()->route('home');
})->name('login');

Route::prefix('admin')/*->middleware('auth')*/->group(function (){

	Route::prefix('departments')->group(function (){
		Route::get('', [DepartmentController::class, 'index'])->name('departments.index');
		Route::get('create', [DepartmentController::class, 'create'])->name('departments.create');
		Route::post('store', [DepartmentController::class, 'store'])->name('departments.store');
		Route::get('{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
		Route::patch('{department}/update', [DepartmentController::class, 'update'])->name('departments.update');
		Route::get('{department}/delete', [DepartmentController::class, 'delete_confirm'])->name('departments.delete_confirm');
		Route::delete('{department}/delete', [DepartmentController::class, 'delete'])->name('departments.delete');

		Route::get('{department}/majors/create', [MajorController::class, 'create'])->name('majors.create');
	});

	Route::prefix('majors')->group(function (){
		Route::get('', [MajorController::class, 'index'])->name('majors.index');
		Route::post('store', [MajorController::class, 'store'])->name('majors.store');
		Route::get('{major}/edit', [MajorController::class, 'edit'])->name('majors.edit');
		Route::patch('{major}/update', [MajorController::class, 'update'])->name('majors.update');
		Route::get('{major}/delete', [MajorController::class, 'delete_confirm'])->name('majors.delete_confirm');
		Route::delete('{major}/delete', [MajorController::class, 'delete'])->name('majors.delete');
	});

	Route::prefix('offers')->group(function (){
		Route::prefix('job')->group(function (){
			Route::get('', [JobOfferController::class, 'index'])->name('offers.job.index');
			Route::get('create', [JobOfferController::class, 'create'])->name('offers.job.create');
			Route::post('store', [JobOfferController::class, 'store'])->name('offers.job.store');
			Route::get('{offer}/edit', [JobOfferController::class, 'edit'])->name('offers.job.edit');
			Route::get('{offer}/toggle', [JobOfferController::class, 'toggle'])->name('offers.job.visible.toggle');
			Route::patch('{offer}/update', [JobOfferController::class, 'update'])->name('offers.job.update');
			Route::get('{offer}/delete', [JobOfferController::class, 'delete_confirm'])->name('offers.job.delete_confirm');
			Route::delete('{offer}/delete', [JobOfferController::class, 'delete'])->name('offers.job.delete');
		});

		Route::prefix('scholarship')->group(function (){
			Route::get('', [ScholarshipOfferController::class, 'index'])->name('offers.scholarship.index');
			Route::get('create', [ScholarshipOfferController::class, 'create'])->name('offers.scholarship.create');
			Route::post('store', [ScholarshipOfferController::class, 'store'])->name('offers.scholarship.store');
			Route::get('{offer}/edit', [ScholarshipOfferController::class, 'edit'])->name('offers.scholarship.edit');
			Route::get('{offer}/toggle', [ScholarshipOfferController::class, 'toggle'])->name('offers.scholarship.visible.toggle');
			Route::patch('{offer}/update', [ScholarshipOfferController::class, 'update'])->name('offers.scholarship.update');
			Route::get('{offer}/delete', [ScholarshipOfferController::class, 'delete_confirm'])->name('offers.scholarship.delete_confirm');
			Route::delete('{offer}/delete', [ScholarshipOfferController::class, 'delete'])->name('offers.scholarship.delete');
		});
	});

});