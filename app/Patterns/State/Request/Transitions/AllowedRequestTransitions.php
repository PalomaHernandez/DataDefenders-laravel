<?php

namespace App\Patterns\State\Request\Transitions;

use App\Contracts\RequestTransition;
use App\Patterns\State\Request\RequestStatus;
use InvalidArgumentException;

class AllowedRequestTransitions {

	public const ALL = [
		[
			'current' => RequestStatus::Pending,
			'next' => RequestStatus::Documentation,
			'transition' => PendingToDocumentation::class,
		],
		[
			'current' => RequestStatus::Documentation,
			'next' => RequestStatus::Pending,
			'transition' => DocumentationToPending::class,
		],
		[
			'current' => RequestStatus::Pending,
			'next' => RequestStatus::Approved,
			'transition' => PendingToApproved::class,
		],
		[
			'current' => RequestStatus::Pending,
			'next' => RequestStatus::Rejected,
			'transition' => PendingToRejected::class,
		],
	];

	/**
	 * Obtains the transition required to perform a status change from the current status to the desired one.
	 *
	 * @param RequestStatus $current The current status.
	 * @param RequestStatus $next    The desired status.
	 * @return RequestTransition The transition to be performed.
	 * @throws InvalidArgumentException When the transition is not defined and therefore cannot be executed.
	 */
	public static function getTransition(RequestStatus $current, RequestStatus $next):RequestTransition{
		$item = collect(self::ALL)->first(fn(array $t) => $t['current'] === $current && $t['next'] === $next);

		if(!$item){
			throw new InvalidArgumentException("No transition for $current->value -> $next->value");
		}

		return new $item['transition'];
	}

}