<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScholarshipOfferController;

Route::get('', [ScholarshipOfferController::class, 'index'])->name('offers.scholarship.index')->can('list.offers');
Route::get('create', [ScholarshipOfferController::class, 'create'])->name('offers.scholarship.create')->can('create.offers');
Route::post('store', [ScholarshipOfferController::class, 'store'])->name('offers.scholarship.store')->can('create.offers');
Route::get('{offer}/edit', [ScholarshipOfferController::class, 'edit'])->name('offers.scholarship.edit')->can('edit.offers');
Route::patch('{offer}/update', [ScholarshipOfferController::class, 'update'])->name('offers.scholarship.update')->can('edit.offers');
Route::get('{offer}/delete', [ScholarshipOfferController::class, 'delete_confirm'])->name('offers.scholarship.delete_confirm')->can('delete.offers');
Route::delete('{offer}/delete', [ScholarshipOfferController::class, 'delete'])->name('offers.scholarship.delete')->can('delete.offers');