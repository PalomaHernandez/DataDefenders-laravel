<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

trait HandlesApplications {

	private function handleApplication(int $offerId):JsonResponse{
		try {
			$offer = $this->offerRepository->findById($offerId);
			[$applicationId, $paymentUrl] = $this->applicationRepository->apply($offer);
			return response()->json([
				'res' => true,
				'text' => 'Applied successfully.',
				'applicationId' => $applicationId,
				'paymentUrl' => $paymentUrl,
			]);
		} catch(Exception $exception){
			Log::error($exception->getTraceAsString());
			return response()->json([
				'res' => false,
				'text' => 'Could not apply.'
			]);
		}
	}

}