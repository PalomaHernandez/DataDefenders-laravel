<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');