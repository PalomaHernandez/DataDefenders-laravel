<?php

use App\Http\Controllers\JobOfferController;
use Illuminate\Support\Facades\Route;

Route::get('', [JobOfferController::class, 'index'])->name('offers.job.index')->can('list.offers');
Route::get('create', [JobOfferController::class, 'create'])->name('offers.job.create')->can('create.offers');
Route::post('store', [JobOfferController::class, 'store'])->name('offers.job.store')->can('create.offers');
Route::get('{offer}/edit', [JobOfferController::class, 'edit'])->name('offers.job.edit')->can('edit.offers');
Route::patch('{offer}/update', [JobOfferController::class, 'update'])->name('offers.job.update')->can('edit.offers');
Route::get('{offer}/delete', [JobOfferController::class, 'delete_confirm'])->name('offers.job.delete_confirm')->can('delete.offers');
Route::delete('{offer}/delete', [JobOfferController::class, 'delete'])->name('offers.job.delete')->can('delete.offers');