<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MajorController;
use Illuminate\Support\Facades\Route;

Route::get('', [DepartmentController::class, 'index'])->name('departments.index')->can('list.departments');
Route::get('create', [DepartmentController::class, 'create'])->name('departments.create')->can('create.departments');
Route::post('store', [DepartmentController::class, 'store'])->name('departments.store')->can('create.departments');
Route::get('{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit')->can('edit.departments');
Route::patch('{department}/update', [DepartmentController::class, 'update'])->name('departments.update')->can('edit.departments');
Route::get('{department}/delete', [DepartmentController::class, 'delete_confirm'])->name('departments.delete_confirm')->can('delete.departments');
Route::delete('{department}/delete', [DepartmentController::class, 'delete'])->name('departments.delete')->can('delete.departments');

Route::get('{department}/majors/create', [MajorController::class, 'create'])->name('majors.create')->can('create.majors');