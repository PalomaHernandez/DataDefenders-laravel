<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScholarshipRequestController;

Route::get('scholarship', [ScholarshipRequestController::class, 'index'])->name('requests.scholarship.index')->can('list.requests');