<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class RequestCannotBeUpdatedException extends Exception {

	public function __construct(string $message = "This request cannot be updated because it has been accepted or rejected already.", int $code = 0, ?Throwable $previous = null){
		parent::__construct($message, $code, $previous);
	}

}
