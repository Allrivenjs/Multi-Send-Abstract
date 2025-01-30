<?php

namespace Core\BoundedContext\UserManagement\InfrastructureLayer\Controllers;

use Core\BoundedContext\UserManagement\ApplicationLayer\Actions\RequestPasswordReset;
use Core\BoundedContext\UserManagement\DomainLayer\Exceptions\PhoneAlreadyExists;
use Core\BoundedContext\UserManagement\DomainLayer\Services\CodeSenderInterface;
use Core\BoundedContext\UserManagement\InfrastructureLayer\Requests\ChangePhoneNumberRequest;
use Core\BoundedContext\UserManagement\InfrastructureLayer\Requests\ValidateEmailRequest;
use Core\BoundedContext\UserManagement\InfrastructureLayer\Requests\ValidatePhoneNumberRequest;
use Core\Shared\Domain\DomainException;
use Random\RandomException;
use Symfony\Component\HttpFoundation\Response;

final readonly class RequestPasswordResetByEMAILPostController
{
    public function __construct(
        private RequestPasswordReset $requestPasswordReset,
    )
    {
    }

    /**
     * @throws PhoneAlreadyExists
     * @throws RandomException
     * @throws DomainException
     */
    public function __invoke(ValidateEmailRequest $request): Response
    {
        $data = $request->validated();
        $response = ($this->requestPasswordReset)($data['email']);

        return response()->json([
            'message' => 'OTP sent successfully',
            ...$response
        ]);
    }
}
