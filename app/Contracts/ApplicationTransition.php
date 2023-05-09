<?php

namespace App\Contracts;

use App\Exceptions\TransitionNotAllowedException;
use App\Models\Application;

interface ApplicationTransition {

	/**
	 * Performs a status change on the request.
	 *
	 * @param Application $application The request to modify.
	 * @return Application The modified request.
	 * @throws TransitionNotAllowedException When a status transition is not allowed due to being final.
	 */
	public function execute(Application $application):Application;

}