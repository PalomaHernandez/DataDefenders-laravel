<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScholarshipApplicationController;

Route::get('scholarship', [ScholarshipApplicationController::class, 'index'])->name('applications.scholarship.index')->can('list.requests');