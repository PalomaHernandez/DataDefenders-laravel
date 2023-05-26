<?php

namespace App\Patterns\State\Request\Transitions;

use App\Contracts\ApplicationTransition;
use App\Exceptions\TransitionNotAllowedException;
use App\Models\Application;
use App\Patterns\State\Request\ApplicationStatus;

class DocumentationToPending implements ApplicationTransition {

	public function execute(Application $application):Application{
		if($application->status !== ApplicationStatus::Documentation){
			throw new TransitionNotAllowedException();
		}

		$application->update([
			'status' => ApplicationStatus::Pending
		]);

		return $application;
	}

}