<?php

use App\Http\Controllers\ScholarshipRequestController;

Route::get('/', [ScholarshipRequestController::class, 'all']);
Route::get('/pending', [ScholarshipRequestController::class, 'pending']);
Route::get('/documentation', [ScholarshipRequestController::class, 'documentation']);
Route::get('/accepted', [ScholarshipRequestController::class, 'accepted']);
Route::get('/rejected', [ScholarshipRequestController::class, 'rejected']);

Route::get('/paginated', [ScholarshipRequestController::class, 'allPaginated']);
Route::get('/pending/paginated', [ScholarshipRequestController::class, 'pendingPaginated']);
Route::get('/documentation/paginated', [ScholarshipRequestController::class, 'documentationPaginated']);
Route::get('/accepted/paginated', [ScholarshipRequestController::class, 'acceptedPaginated']);
Route::get('/rejected/paginated', [ScholarshipRequestController::class, 'rejectedPaginated']);