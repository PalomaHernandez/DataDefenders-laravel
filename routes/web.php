<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\PasswordChangeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\RequestController;
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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'checkLogin'])->name('login.attempt');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/account-recovery', [PasswordResetController::class, 'index'])->name('accountrecovery');
Route::post('/account-recovery', [PasswordResetController::class, 'sendResetLink'])->name('reset.link.send');

Route::get('/reset-password', [PasswordChangeController::class, 'index'])->name('reset.password');
Route::post('/reset-password', [PasswordChangeController::class, 'changePassword'])->name('change.password');

Route::prefix('admin')->middleware('auth')->group(function (){

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

	Route::prefix('requests')->group(function (){
		Route::get('', [RequestController::class, 'index'])->name('requests.index');
		Route::get('job', [RequestController::class, 'job'])->name('requests.job.index');
		Route::get('scholarship', [RequestController::class, 'scholarship'])->name('requests.scholarship.index');
		Route::get('{request}/edit', [RequestController::class, 'edit'])->name('requests.edit');
		Route::get('{request}/document', [RequestController::class, 'document_confirm'])->name('requests.document_confirm');
		Route::patch('{request}/document', [RequestController::class, 'document'])->name('requests.document');
		Route::get('{request}/accept', [RequestController::class, 'accept_confirm'])->name('requests.accept_confirm');
		Route::patch('{request}/accept', [RequestController::class, 'accept'])->name('requests.accept');
		Route::get('{request}/reject', [RequestController::class, 'reject_confirm'])->name('requests.reject_confirm');
		Route::patch('{request}/reject', [RequestController::class, 'reject'])->name('requests.reject');
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