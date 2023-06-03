<?php

use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index']);
Route::patch('/update', [UserController::class, 'update']);
