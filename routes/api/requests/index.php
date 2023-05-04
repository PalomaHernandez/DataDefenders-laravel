<?php

use App\Http\Controllers\RequestController;

Route::get('/', [RequestController::class, 'all']);
Route::get('/pending', [RequestController::class, 'pending']);
Route::get('/documentation', [RequestController::class, 'documentation']);
Route::get('/accepted', [RequestController::class, 'accepted']);
Route::get('/rejected', [RequestController::class, 'rejected']);

Route::get('/paginated', [RequestController::class, 'allPaginated']);
Route::get('/pending/paginated', [RequestController::class, 'pendingPaginated']);
Route::get('/documentation/paginated', [RequestController::class, 'documentationPaginated']);
Route::get('/accepted/paginated', [RequestController::class, 'acceptedPaginated']);
Route::get('/rejected/paginated', [RequestController::class, 'rejectedPaginated']);

Route::get('/{requestId}/find', [RequestController::class, 'find']);
Route::post('/{requestId}/review', [RequestController::class, 'review']);
Route::post('/{requestId}/document', [RequestController::class, 'document']);
Route::post('/{requestId}/accept', [RequestController::class, 'accept']);
Route::post('/{requestId}/reject', [RequestController::class, 'reject']);