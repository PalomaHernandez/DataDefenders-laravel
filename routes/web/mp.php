<?php

use App\Http\Controllers\MercadoPagoController;

Route::get('/{applicationId}/payment', [MercadoPagoController::class, 'payment'])->name('application.payment');