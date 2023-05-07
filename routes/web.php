<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\PasswordChangeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\JobRequestController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ScholarshipOfferController;
use App\Http\Controllers\ScholarshipRequestController;
use App\Http\Controllers\UserController;
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
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'attempt'])->name('login.attempt');

Route::get('/account-recovery', [PasswordResetController::class, 'index'])->name('account.recovery');
Route::post('/account-recovery', [PasswordResetController::class, 'sendResetLink'])->name('reset.link.send');

Route::get('/reset-password', [PasswordChangeController::class, 'index'])->name('password.reset');
Route::post('/reset-password', [PasswordChangeController::class, 'changePassword'])->name('password.change');

Route::middleware('auth')->group(function (){
	Route::get('/', function () {
		return view('welcome');
	})->name('home');

	Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

	Route::prefix('my-account')->group(function (){
		Route::get('/edit', [UserController::class, 'edit'])->name('users.edit');
		Route::patch('/update', [UserController::class, 'update'])->name('users.update');
	});

	Route::prefix('admin')->group(function (){
		Route::prefix('departments')->group(function (){
			Route::get('', [DepartmentController::class, 'index'])->name('departments.index')->can('list.departments');
			Route::get('create', [DepartmentController::class, 'create'])->name('departments.create')->can('create.departments');
			Route::post('store', [DepartmentController::class, 'store'])->name('departments.store')->can('create.departments');
			Route::get('{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit')->can('edit.departments');
			Route::patch('{department}/update', [DepartmentController::class, 'update'])->name('departments.update')->can('edit.departments');
			Route::get('{department}/delete', [DepartmentController::class, 'delete_confirm'])->name('departments.delete_confirm')->can('delete.departments');
			Route::delete('{department}/delete', [DepartmentController::class, 'delete'])->name('departments.delete')->can('delete.departments');

			Route::get('{department}/majors/create', [MajorController::class, 'create'])->name('majors.create')->can('create.majors');
		});

		Route::prefix('majors')->group(function (){
			Route::get('', [MajorController::class, 'index'])->name('majors.index')->can('list.majors');
			Route::post('store', [MajorController::class, 'store'])->name('majors.store')->can('create.majors');
			Route::get('{major}/edit', [MajorController::class, 'edit'])->name('majors.edit')->can('edit.majors');
			Route::patch('{major}/update', [MajorController::class, 'update'])->name('majors.update')->can('edit.majors');
			Route::get('{major}/delete', [MajorController::class, 'delete_confirm'])->name('majors.delete_confirm')->can('delete.majors');
			Route::delete('{major}/delete', [MajorController::class, 'delete'])->name('majors.delete')->can('delete.majors');
		});

		Route::prefix('requests')->group(function (){
			Route::get('', [RequestController::class, 'index'])->name('requests.index')->can('list.requests');
			Route::get('{request}/edit', [RequestController::class, 'edit'])->name('requests.edit')->can('list.requests');
			Route::get('{request}/document', [RequestController::class, 'document_confirm'])->name('requests.document_confirm')->can('require.request.documentation');
			Route::patch('{request}/document', [RequestController::class, 'document'])->name('requests.document')->can('require.request.documentation');
			Route::get('{request}/accept', [RequestController::class, 'accept_confirm'])->name('requests.accept_confirm')->can('accept.requests');
			Route::patch('{request}/accept', [RequestController::class, 'accept'])->name('requests.accept')->can('accept.requests');
			Route::get('{request}/reject', [RequestController::class, 'reject_confirm'])->name('requests.reject_confirm')->can('reject.requests');
			Route::patch('{request}/reject', [RequestController::class, 'reject'])->name('requests.reject')->can('reject.requests');

			Route::get('job', [JobRequestController::class, 'index'])->name('requests.job.index')->can('list.requests');

			Route::get('scholarship', [ScholarshipRequestController::class, 'index'])->name('requests.scholarship.index')->can('list.requests');
		});

		Route::prefix('offers')->group(function (){
			Route::prefix('job')->group(function (){
				Route::get('', [JobOfferController::class, 'index'])->name('offers.job.index')->can('list.offers');
				Route::get('create', [JobOfferController::class, 'create'])->name('offers.job.create')->can('create.offers');
				Route::post('store', [JobOfferController::class, 'store'])->name('offers.job.store')->can('create.offers');
				Route::get('{offer}/edit', [JobOfferController::class, 'edit'])->name('offers.job.edit')->can('edit.offers');
				Route::patch('{offer}/update', [JobOfferController::class, 'update'])->name('offers.job.update')->can('edit.offers');
				Route::get('{offer}/delete', [JobOfferController::class, 'delete_confirm'])->name('offers.job.delete_confirm')->can('delete.offers');
				Route::delete('{offer}/delete', [JobOfferController::class, 'delete'])->name('offers.job.delete')->can('delete.offers');
			});

			Route::prefix('scholarship')->group(function (){
				Route::get('', [ScholarshipOfferController::class, 'index'])->name('offers.scholarship.index')->can('list.offers');
				Route::get('create', [ScholarshipOfferController::class, 'create'])->name('offers.scholarship.create')->can('create.offers');
				Route::post('store', [ScholarshipOfferController::class, 'store'])->name('offers.scholarship.store')->can('create.offers');
				Route::get('{offer}/edit', [ScholarshipOfferController::class, 'edit'])->name('offers.scholarship.edit')->can('edit.offers');
				Route::patch('{offer}/update', [ScholarshipOfferController::class, 'update'])->name('offers.scholarship.update')->can('edit.offers');
				Route::get('{offer}/delete', [ScholarshipOfferController::class, 'delete_confirm'])->name('offers.scholarship.delete_confirm')->can('delete.offers');
				Route::delete('{offer}/delete', [ScholarshipOfferController::class, 'delete'])->name('offers.scholarship.delete')->can('delete.offers');
			});
		});
	});
});