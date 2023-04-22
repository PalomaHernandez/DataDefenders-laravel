<?php

use App\Http\Controllers\DepartmentController;
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
});

Route::prefix('admin')->group(function (){

	Route::prefix('departments')->group(function (){

		Route::get('', [DepartmentController::class, 'index'])->name('departments.index');
		Route::get('create', [DepartmentController::class, 'create'])->name('departments.create');
		Route::post('store', [DepartmentController::class, 'store'])->name('departments.store');
		Route::get('{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
		Route::patch('{department}/update', [DepartmentController::class, 'update'])->name('departments.update');
		Route::delete('{department}/delete', [DepartmentController::class, 'delete'])->name('departments.delete');

		Route::get('{department}/majors/create', [MajorController::class, 'create'])->name('majors.create');
		

	});

	Route::prefix('majors')->group(function (){

		Route::get('', [MajorController::class, 'index'])->name('majors.index');
		Route::post('store', [MajorController::class, 'store'])->name('majors.store');
		Route::get('{major}/edit', [MajorController::class, 'edit'])->name('majors.edit');
		Route::patch('{major}/update', [MajorController::class, 'update'])->name('majors.update');
		Route::delete('{major}/delete', [MajorController::class, 'delete'])->name('majors.delete');
	});

	Route::prefix('scholarshipoffers')->group(function (){

		Route::get('', [ScholarshipOfferController::class, 'index'])->name('scholarshipoffers.index');
		Route::get('create', [ScholarshipOfferController::class, 'create'])->name('scholarshipoffers.create');
		Route::post('store', [ScholarshipOfferController::class, 'store'])->name('scholarshipoffers.store');
		Route::get('{scholarshipoffer}/edit', [ScholarshipOfferController::class, 'edit'])->name('scholarshipoffers.edit');
		Route::patch('{scholarshipoffer}/update', [ScholarshipOfferController::class, 'update'])->name('scholarshipoffers.update');
		Route::delete('{scholarshipoffer}/delete', [ScholarshipOfferController::class, 'delete'])->name('scholarshipoffers.delete');
	});

});