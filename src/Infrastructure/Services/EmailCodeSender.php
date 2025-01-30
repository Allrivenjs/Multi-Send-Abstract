<?php

namespace Core\BoundedContext\UserManagement\InfrastructureLayer\Services;

use Core\BoundedContext\UserManagement\ApplicationLayer\Actions\FindByEmailUser;
use Core\BoundedContext\UserManagement\ApplicationLayer\Actions\FindByPhoneUser;
use Core\BoundedContext\UserManagement\DomainLayer\Exceptions\UserNotFound;
use Core\BoundedContext\UserManagement\DomainLayer\Services\CodeSenderInterface;
use Core\BoundedContext\UserManagement\DomainLayer\User\User;

class EmailCodeSender implements CodeSenderInterface
{

    public function send(string $to, string $code): void
    {
        // TODO: Implement send() method.
        echo "Email sent to $to with code $code";
    }

    public function getUser(mixed $attr): ?User
    {
        $user = app(FindByEmailUser::class)->__invoke($attr);
        if ($user === null) {
            throw new UserNotFound('This email not exists.');
        }
        return $user;
    }
}
