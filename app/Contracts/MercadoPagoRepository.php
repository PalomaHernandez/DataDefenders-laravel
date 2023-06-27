<?php

namespace App\Contracts;

use App\Models\Application;

interface MercadoPagoRepository {

    public function getPaymentUrl(Application $application): string;

}