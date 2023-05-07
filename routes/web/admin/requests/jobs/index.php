<?php

use App\Http\Controllers\JobRequestController;
use Illuminate\Support\Facades\Route;

Route::get('job', [JobRequestController::class, 'index'])->name('requests.job.index')->can('list.requests');