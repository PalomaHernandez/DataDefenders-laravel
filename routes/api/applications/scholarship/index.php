<?php

use App\Http\Controllers\ScholarshipApplicationController;

Route::get('/', [ScholarshipApplicationController::class, 'all']);
Route::get('/pending', [ScholarshipApplicationController::class, 'pending']);
Route::get('/documentation', [ScholarshipApplicationController::class, 'documentation']);
Route::get('/accepted', [ScholarshipApplicationController::class, 'accepted']);
Route::get('/rejected', [ScholarshipApplicationController::class, 'rejected']);

Route::get('/paginated', [ScholarshipApplicationController::class, 'allPaginated']);
Route::get('/pending/paginated', [ScholarshipApplicationController::class, 'pendingPaginated']);
Route::get('/documentation/paginated', [ScholarshipApplicationController::class, 'documentationPaginated']);
Route::get('/accepted/paginated', [ScholarshipApplicationController::class, 'acceptedPaginated']);
Route::get('/rejected/paginated', [ScholarshipApplicationController::class, 'rejectedPaginated']);