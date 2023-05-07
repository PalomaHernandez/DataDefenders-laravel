<?php

use App\Http\Controllers\MajorController;
use Illuminate\Support\Facades\Route;

Route::get('', [MajorController::class, 'index'])->name('majors.index')->can('list.majors');
Route::post('store', [MajorController::class, 'store'])->name('majors.store')->can('create.majors');
Route::get('{major}/edit', [MajorController::class, 'edit'])->name('majors.edit')->can('edit.majors');
Route::patch('{major}/update', [MajorController::class, 'update'])->name('majors.update')->can('edit.majors');
Route::get('{major}/delete', [MajorController::class, 'delete_confirm'])->name('majors.delete_confirm')->can('delete.majors');
Route::delete('{major}/delete', [MajorController::class, 'delete'])->name('majors.delete')->can('delete.majors');
