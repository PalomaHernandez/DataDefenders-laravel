<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class DepartmentHasAtLeastOneOfferException extends Exception {

	public function __construct(string $message = 'This department cannot be deleted because it has at least one Job Offer assigned to it.', int $code = 0, ?Throwable $previous = null){
		parent::__construct($message, $code, $previous);
	}

}
