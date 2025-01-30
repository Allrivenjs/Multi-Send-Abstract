<?php

declare(strict_types=1);

namespace Core\BoundedContext\UserManagement\DomainLayer\Exceptions;

use Core\Shared\Domain\DomainException;
use Throwable;

final class UserNotFound extends DomainException
{
    public function __construct($message = "", $code = 404, Throwable $previous = null)
    {
        $message = "" === $message ? "User not found" : $message;

        parent::__construct($message, $code, $previous);
    }
}
