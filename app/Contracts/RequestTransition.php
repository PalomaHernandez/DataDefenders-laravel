<?php

namespace App\Contracts;

use App\Exceptions\TransitionNotAllowedException;
use App\Models\Request;

interface RequestTransition {

	/**
	 * Performs a status change on the request.
	 * @param Request $request The request to modify.
	 * @return Request The modified request.
	 * @throws TransitionNotAllowedException When a status transition is not allowed due to being final.
	 */
	public function execute(Request $request):Request;

}