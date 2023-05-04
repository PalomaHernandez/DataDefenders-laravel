<?php

use App\Http\Controllers\JobRequestController;

Route::get('/', [JobRequestController::class, 'all']);
Route::get('/pending', [JobRequestController::class, 'pending']);
Route::get('/documentation', [JobRequestController::class, 'documentation']);
Route::get('/accepted', [JobRequestController::class, 'accepted']);
Route::get('/rejected', [JobRequestController::class, 'rejected']);

Route::get('/paginated', [JobRequestController::class, 'allPaginated']);
Route::get('/pending/paginated', [JobRequestController::class, 'pendingPaginated']);
Route::get('/documentation/paginated', [JobRequestController::class, 'documentationPaginated']);
Route::get('/accepted/paginated', [JobRequestController::class, 'acceptedPaginated']);
Route::get('/rejected/paginated', [JobRequestController::class, 'rejectedPaginated']);