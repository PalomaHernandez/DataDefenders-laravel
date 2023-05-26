<?php

use App\Http\Controllers\AccountController;

Route::get('/', [AccountController::class, 'index']);
Route::patch('/update', [AccountController::class, 'update']);