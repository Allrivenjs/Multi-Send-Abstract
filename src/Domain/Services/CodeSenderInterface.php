<?php

namespace Core\BoundedContext\UserManagement\DomainLayer\Services;

use Core\BoundedContext\UserManagement\DomainLayer\Exceptions\PhoneAlreadyExists;
use Core\BoundedContext\UserManagement\DomainLayer\User\User;
use Core\Shared\Domain\DomainException;

interface CodeSenderInterface
{
    public function send(string $to, string $code): void;

    /**
     * @throws DomainException
     */
    public function getUser(mixed $attr): ?User;
}
