<?php

use App\Http\Controllers\ScholarshipOfferController;

Route::get('/', [ScholarshipOfferController::class, 'all']);
Route::get('/paginated', [ScholarshipOfferController::class, 'allPaginated']);
Route::get('/{offer}/find', [ScholarshipOfferController::class, 'find']);
Route::post('/{offer}/store', [ScholarshipOfferController::class, 'store']);
Route::patch('/{offer}/update', [ScholarshipOfferController::class, 'update']);
Route::post('/{offer}/apply', [ScholarshipOfferController::class, 'apply']);
Route::delete('/{offer}/delete', [ScholarshipOfferController::class, 'delete']);