<?php

use App\Http\Controllers\DepartmentController;

Route::get('/', [DepartmentController::class, 'index']);
Route::post('/store', [DepartmentController::class, 'store']);
Route::get('/{departmentId}/find', [DepartmentController::class, 'find']);
Route::patch('/{departmentId}/update', [DepartmentController::class, 'update']);
Route::delete('/{departmentId}/delete', [DepartmentController::class, 'delete']);