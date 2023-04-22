<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class MajorHasAtLeastOneOfferException extends Exception {

	public function __construct(string $message = 'This major cannot be deleted because it has at least one Scholarship Offer assigned to it.', int $code = 0, ?Throwable $previous = null){
		parent::__construct($message, $code, $previous);
	}

}
