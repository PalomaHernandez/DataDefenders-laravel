<?php

use App\Http\Controllers\ApplicationController;

Route::get('/', [ApplicationController::class, 'all']);
Route::get('/pending', [ApplicationController::class, 'pending']);
Route::get('/documentation', [ApplicationController::class, 'documentation']);
Route::get('/accepted', [ApplicationController::class, 'accepted']);
Route::get('/rejected', [ApplicationController::class, 'rejected']);

Route::get('/paginated', [ApplicationController::class, 'allPaginated']);
Route::get('/pending/paginated', [ApplicationController::class, 'pendingPaginated']);
Route::get('/documentation/paginated', [ApplicationController::class, 'documentationPaginated']);
Route::get('/accepted/paginated', [ApplicationController::class, 'acceptedPaginated']);
Route::get('/rejected/paginated', [ApplicationController::class, 'rejectedPaginated']);

Route::get('/{requestId}/find', [ApplicationController::class, 'find']);
Route::post('/{requestId}/review', [ApplicationController::class, 'review']);
Route::post('/{requestId}/document', [ApplicationController::class, 'document']);
Route::post('/{requestId}/accept', [ApplicationController::class, 'accept']);
Route::post('/{requestId}/reject', [ApplicationController::class, 'reject']);