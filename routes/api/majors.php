<?php

use App\Http\Controllers\MajorController;

Route::get('/', [MajorController::class, 'index']);
Route::post('/store', [MajorController::class, 'store']);
Route::patch('/{majorId}/find', [MajorController::class, 'find']);
Route::patch('/{majorId}/update', [MajorController::class, 'update']);
Route::delete('/{majorId}/delete', [MajorController::class, 'delete']);