<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('', [UserController::class, 'index'])->name('users.index');
Route::get('/edit', [UserController::class, 'edit'])->name('users.edit');
Route::patch('/{user}/update', [UserController::class, 'update'])->name('users.update');