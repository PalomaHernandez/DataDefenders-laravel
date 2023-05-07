<?php

use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

Route::get('', [RequestController::class, 'index'])->name('requests.index')->can('list.requests');
Route::get('{request}/edit', [RequestController::class, 'edit'])->name('requests.edit')->can('list.requests');
Route::get('{request}/document', [RequestController::class, 'document_confirm'])->name('requests.document_confirm')->can('require.request.documentation');
Route::patch('{request}/document', [RequestController::class, 'document'])->name('requests.document')->can('require.request.documentation');
Route::get('{request}/accept', [RequestController::class, 'accept_confirm'])->name('requests.accept_confirm')->can('accept.requests');
Route::patch('{request}/accept', [RequestController::class, 'accept'])->name('requests.accept')->can('accept.requests');
Route::get('{request}/reject', [RequestController::class, 'reject_confirm'])->name('requests.reject_confirm')->can('reject.requests');
Route::patch('{request}/reject', [RequestController::class, 'reject'])->name('requests.reject')->can('reject.requests');