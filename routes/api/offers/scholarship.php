<?php

use App\Http\Controllers\ScholarshipOfferController;

Route::get('/', [ScholarshipOfferController::class, 'all']);
Route::get('/paginated', [ScholarshipOfferController::class, 'allPaginated']);
Route::get('/{offerId}/find', [ScholarshipOfferController::class, 'find']);
Route::post('/{offerId}/store', [ScholarshipOfferController::class, 'store']);
Route::patch('/{offerId}/update', [ScholarshipOfferController::class, 'update']);
Route::delete('/{offerId}/delete', [ScholarshipOfferController::class, 'delete']);