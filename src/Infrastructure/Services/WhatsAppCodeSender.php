<?php

namespace Core\BoundedContext\UserManagement\InfrastructureLayer\Services;

use Core\BoundedContext\UserManagement\ApplicationLayer\Actions\FindByPhoneUser;
use Core\BoundedContext\UserManagement\DomainLayer\Exceptions\PhoneAlreadyExists;
use Core\BoundedContext\UserManagement\DomainLayer\Exceptions\UserNotFound;
use Core\BoundedContext\UserManagement\DomainLayer\Services\CodeSenderInterface;
use Core\BoundedContext\UserManagement\DomainLayer\User\User;

class WhatsAppCodeSender implements CodeSenderInterface
{

    public function send(string $to, string $code): void
    {
        // TODO: Implement send() method.
        echo "WhatsApp sent to $to with code $code";
    }

    public function getUser(mixed $attr): ?User
    {
        $user = app(FindByPhoneUser::class)->__invoke($attr);
        if ($user === null) {
            throw new UserNotFound('This telephone number not exists.');
        }
        return $user;
    }
}
