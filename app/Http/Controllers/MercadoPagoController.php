<?php

namespace App\Http\Controllers;

use App\Actions\ChangeRequestStatus;
use App\Contracts\ApplicationRepository;
use App\Patterns\State\Request\ApplicationStatus;

class MercadoPagoController extends Controller {

	public function __construct(
		private readonly ApplicationRepository $applicationRepository,
	){}

    public function payment(int $applicationId){
		$application = $this->applicationRepository->findById($applicationId);
		ChangeRequestStatus::execute($application, ApplicationStatus::Pending);
		$this->applicationRepository->updatePaymentUrl($application, null);
		return redirect("http://127.0.0.1:5173/applications/{$applicationId}");
	}

}