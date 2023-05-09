<?php

namespace App\Actions;

use App\Exceptions\TransitionNotAllowedException;
use App\Models\Application;
use App\Patterns\State\Request\ApplicationStatus;
use App\Patterns\State\Request\Transitions\AllowedApplicationTransitions;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class ChangeRequestStatus {

	/**
	 * @throws InvalidArgumentException|TransitionNotAllowedException
	 */
	public static function execute(Application $request, ApplicationStatus $nextStatus):Application{
		return DB::transaction(function() use ($request, $nextStatus){
			return AllowedApplicationTransitions::getTransition($request->status, $nextStatus)->execute($request);
		});
	}

}