<?php

namespace App\Contracts;

interface MercadoPagoRepository {

    public function createPayment(int $applicationId): string;

}