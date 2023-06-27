<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\MercadoPagoController;

Route::get('/', [ApplicationController::class, 'all']);
Route::get('/payment', [ApplicationController::class, 'payment']);
Route::get('/pending', [ApplicationController::class, 'pending']);
Route::get('/documentation', [ApplicationController::class, 'documentation']);
Route::get('/accepted', [ApplicationController::class, 'accepted']);
Route::get('/rejected', [ApplicationController::class, 'rejected']);

Route::get('/paginated', [ApplicationController::class, 'allPaginated']);
Route::get('/payment/paginated', [ApplicationController::class, 'paymentPaginated']);
Route::get('/pending/paginated', [ApplicationController::class, 'pendingPaginated']);
Route::get('/documentation/paginated', [ApplicationController::class, 'documentationPaginated']);
Route::get('/accepted/paginated', [ApplicationController::class, 'acceptedPaginated']);
Route::get('/rejected/paginated', [ApplicationController::class, 'rejectedPaginated']);

Route::get('/{applicationId}/find', [ApplicationController::class, 'find']);
Route::post('/{applicationId}/review', [ApplicationController::class, 'review']);
Route::post('/{applicationId}/document', [ApplicationController::class, 'document']);
Route::post('/{applicationId}/accept', [ApplicationController::class, 'accept']);
Route::post('/{applicationId}/reject', [ApplicationController::class, 'reject']);