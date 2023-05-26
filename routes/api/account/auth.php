<?php

use App\Http\Controllers\Auth\LoginController;

Route::middleware('guest')->post('/login', [LoginController::class, 'attempt']);
Route::post('/logout', [LoginController::class, 'logout']);