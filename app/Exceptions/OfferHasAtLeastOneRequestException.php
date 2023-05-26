<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class OfferHasAtLeastOneRequestException extends Exception {

	public function __construct(string $message = 'This offer cannot be deleted because someone has already applied for it.', int $code = 0, ?Throwable $previous = null){
		parent::__construct($message, $code, $previous);
	}

}
