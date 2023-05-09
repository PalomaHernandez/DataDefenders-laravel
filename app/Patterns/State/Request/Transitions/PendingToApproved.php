<?php

namespace App\Patterns\State\Request\Transitions;

use App\Contracts\ApplicationTransition;
use App\Exceptions\TransitionNotAllowedException;
use App\Models\Application;
use App\Patterns\State\Request\ApplicationStatus;

class PendingToApproved implements ApplicationTransition {

	public function execute(Application $application):Application{
		if($application->status !== ApplicationStatus::Pending){
			throw new TransitionNotAllowedException();
		}

		$application->update([
			'status' => ApplicationStatus::Accepted
		]);

		return $application;
	}

}