<?php

use App\Http\Controllers\JobApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('job', [JobApplicationController::class, 'index'])->name('applications.job.index')->can('list.requests');