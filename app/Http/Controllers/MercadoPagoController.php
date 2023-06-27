<?php

namespace App\Http\Controllers;

use App\Actions\ChangeRequestStatus;
use App\Contracts\ApplicationRepository;
use App\Exceptions\TransitionNotAllowedException;
use App\Patterns\State\Request\ApplicationStatus;
use Illuminate\Validation\ValidationException;

class MercadoPagoController extends Controller {

	public function __construct(private readonly ApplicationRepository $applicationRepository){}

	public function payment(int $applicationId){
		request()->validate([
			'status' => ['required', 'string']
		]);
		try {
			$application = $this->applicationRepository->findById($applicationId);
			if(request('status') == 'approved'){
				ChangeRequestStatus::execute($application, ApplicationStatus::Pending);
				$this->applicationRepository->updatePaymentUrl($application, null);
			}
			return redirect("https://spa-unimanager.snowlinks.net/applications/$applicationId");
		} catch(TransitionNotAllowedException $exception){
			throw ValidationException::withMessages([
				'general' => $exception->getMessage()
			]);
		}
	}

}