<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class TransitionNotAllowedException extends Exception {

	public function __construct(string $message = "Transition not allowed.", int $code = 0, ?Throwable $previous = null){
		parent::__construct($message, $code, $previous);
	}

}