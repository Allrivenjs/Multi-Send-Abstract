<?php


use Core\BoundedContext\UserManagement\DomainLayer\Exceptions\PhoneAlreadyExists;
use Core\BoundedContext\UserManagement\DomainLayer\Services\CodeSenderInterface;
use Core\BoundedContext\UserManagement\DomainLayer\User\IUserRepository;
use Core\BoundedContext\UserManagement\DomainLayer\User\ValueObjects\UserTelephone;
use Core\Shared\Domain\DomainException;
use Random\RandomException;

class RequestPasswordReset
{
    public function __construct(
        private CodeSenderInterface $codeSender, // Inyección de la interfaz
    )
    {
    }

    /**
     * @throws PhoneAlreadyExists
     * @throws RandomException
     * @throws DomainException
     */
    public function __invoke(string $telephone): array
    {
        //TODO: define methos to send code.
        $user = $this->codeSender->getUser(new UserTelephone($telephone));

        //todo: send token.
        $code = $this->generateCode(); // Genera un código OTP
        $this->codeSender->send($user->telephone()->value(), $code);

        // if retorn user and code if app in local environment
        return \Core\BoundedContext\UserManagement\ApplicationLayer\Actions\env('APP_ENV') === 'local'
            ? ['user' => $user, 'code' => $code]
            : [];
    }

    /**
     * @throws RandomException
     */
    private function generateCode(): string
    {
        return (string)random_int(100000, 999999);
    }
}
