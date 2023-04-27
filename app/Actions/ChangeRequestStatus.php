<?php

namespace App\Actions;

use App\Exceptions\TransitionNotAllowedException;
use App\Models\Request;
use App\Patterns\State\Request\RequestStatus;
use App\Patterns\State\Request\Transitions\AllowedRequestTransitions;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class ChangeRequestStatus {

	/**
	 * @throws InvalidArgumentException|TransitionNotAllowedException
	 */
	public static function execute(Request $request, RequestStatus $nextStatus):Request{
		return DB::transaction(function() use ($request, $nextStatus){
			return AllowedRequestTransitions::getTransition($request->status, $nextStatus)->execute($request);
		});
	}

}