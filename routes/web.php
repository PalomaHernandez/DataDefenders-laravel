<?php

use App\Http\Controllers\DepartmentController;
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

	});

});