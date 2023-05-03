<?php

use App\Http\Controllers\JobOfferController;

Route::get('/', [JobOfferController::class, 'all']);
Route::get('/paginated', [JobOfferController::class, 'allPaginated']);
Route::get('/{offerId}/find', [JobOfferController::class, 'find']);
Route::post('/{offerId}/store', [JobOfferController::class, 'store']);
Route::patch('/{offerId}/update', [JobOfferController::class, 'update']);
Route::delete('/{offerId}/delete', [JobOfferController::class, 'delete']);