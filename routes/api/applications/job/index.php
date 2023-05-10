<?php

use App\Http\Controllers\JobApplicationController;

Route::get('/', [JobApplicationController::class, 'all']);
Route::get('/pending', [JobApplicationController::class, 'pending']);
Route::get('/documentation', [JobApplicationController::class, 'documentation']);
Route::get('/accepted', [JobApplicationController::class, 'accepted']);
Route::get('/rejected', [JobApplicationController::class, 'rejected']);

Route::get('/paginated', [JobApplicationController::class, 'allPaginated']);
Route::get('/pending/paginated', [JobApplicationController::class, 'pendingPaginated']);
Route::get('/documentation/paginated', [JobApplicationController::class, 'documentationPaginated']);
Route::get('/accepted/paginated', [JobApplicationController::class, 'acceptedPaginated']);
Route::get('/rejected/paginated', [JobApplicationController::class, 'rejectedPaginated']);