<?php

use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('', [ApplicationController::class, 'index'])->name('applications.index')->can('list.applications');
Route::get('{application}/edit', [ApplicationController::class, 'edit'])->name('applications.edit')->can('list.applications');
Route::get('{application}/document', [ApplicationController::class, 'document_confirm'])->name('applications.document_confirm')->can('require.application.documentation');
Route::patch('{application}/document', [ApplicationController::class, 'document'])->name('applications.document')->can('require.application.documentation');
Route::get('{application}/accept', [ApplicationController::class, 'accept_confirm'])->name('applications.accept_confirm')->can('accept.applications');
Route::patch('{application}/accept', [ApplicationController::class, 'accept'])->name('applications.accept')->can('accept.applications');
Route::get('{application}/reject', [ApplicationController::class, 'reject_confirm'])->name('applications.reject_confirm')->can('reject.applications');
Route::patch('{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject')->can('reject.applications');