<?php

namespace App\Traits;
use App\Models\Application;

trait UpdatesPaymentUrl{

    public function updatePaymentUrl(Application $application, ?string $paymentUrl): void{
		$application->payment_url = $paymentUrl;
		$application->save();
	}

}