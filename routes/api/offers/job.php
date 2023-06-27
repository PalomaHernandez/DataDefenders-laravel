<?php

use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\MercadoPagoController;

Route::get('/', [JobOfferController::class, 'all']);
Route::get('/paginated', [JobOfferController::class, 'allPaginated']);
Route::get('/{offer}/find', [JobOfferController::class, 'find']);
Route::post('/{offer}/store', [JobOfferController::class, 'store']);
Route::patch('/{offer}/update', [JobOfferController::class, 'update']);
Route::post('/{offer}/apply', [JobOfferController::class, 'apply']);
Route::delete('/{offer}/delete', [JobOfferController::class, 'delete']);