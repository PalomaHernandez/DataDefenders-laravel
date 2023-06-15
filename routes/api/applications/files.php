<?php

use App\Http\Controllers\ApplicationController;

Route::get('/{documentationFileId}/stream', [ApplicationController::class, 'getFile']);
