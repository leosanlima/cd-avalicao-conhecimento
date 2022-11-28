<?php

namespace App\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;
use Throwable;

class InvalidFirstAccessTokenException extends Exception
{
    #[Pure]
    public function __construct($message = "", $code = 403, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
