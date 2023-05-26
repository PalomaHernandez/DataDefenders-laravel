<?php

namespace App\Patterns\State\Request\Transitions;

use App\Contracts\ApplicationTransition;
use App\Patterns\State\Request\ApplicationStatus;
use InvalidArgumentException;

class AllowedApplicationTransitions {

	public const ALL = [
		[
			'current' => ApplicationStatus::Pending,
			'next' => ApplicationStatus::Documentation,
			'transition' => PendingToDocumentation::class,
		],
		[
			'current' => ApplicationStatus::Documentation,
			'next' => ApplicationStatus::Pending,
			'transition' => DocumentationToPending::class,
		],
		[
			'current' => ApplicationStatus::Pending,
			'next' => ApplicationStatus::Accepted,
			'transition' => PendingToApproved::class,
		],
		[
			'current' => ApplicationStatus::Pending,
			'next' => ApplicationStatus::Rejected,
			'transition' => PendingToRejected::class,
		],
	];

	/**
	 * Obtains the transition required to perform a status change from the current status to the desired one.
	 *
	 * @param ApplicationStatus $current The current status.
	 * @param ApplicationStatus $next    The desired status.
	 * @return ApplicationTransition The transition to be performed.
	 * @throws InvalidArgumentException When the transition is not defined and therefore cannot be executed.
	 */
	public static function getTransition(ApplicationStatus $current, ApplicationStatus $next):ApplicationTransition{
		$item = collect(self::ALL)->first(fn(array $t) => $t['current'] === $current && $t['next'] === $next);

		if(!$item){
			throw new InvalidArgumentException("No transition for $current->value -> $next->value");
		}

		return new $item['transition'];
	}

}