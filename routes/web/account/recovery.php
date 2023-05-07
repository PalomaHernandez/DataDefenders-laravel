<?php

use App\Http\Controllers\Auth\PasswordChangeController;
use App\Http\Controllers\Auth\PasswordResetController;
use Illuminate\Support\Facades\Route;

Route::get('/account-recovery', [PasswordResetController::class, 'index'])->name('account.recovery');
Route::post('/account-recovery', [PasswordResetController::class, 'sendResetLink'])->name('reset.link.send');

Route::get('/reset-password', [PasswordChangeController::class, 'index'])->name('password.reset');
Route::post('/reset-password', [PasswordChangeController::class, 'changePassword'])->name('password.change');