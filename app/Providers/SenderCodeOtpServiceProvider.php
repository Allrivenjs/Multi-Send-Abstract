<?php


use Core\BoundedContext\UserManagement\DomainLayer\Factories\CodeSenderFactory;
use Core\BoundedContext\UserManagement\DomainLayer\Services\CodeSenderInterface;
use Core\BoundedContext\UserManagement\InfrastructureLayer\Controllers\RequestPasswordResetByEMAILPostController;
use Core\BoundedContext\UserManagement\InfrastructureLayer\Controllers\RequestPasswordResetBySMSPostController;
use Core\BoundedContext\UserManagement\InfrastructureLayer\Controllers\RequestPasswordResetByWhatsAppPostController;
use Core\BoundedContext\UserManagement\InfrastructureLayer\Services\EmailCodeSender;
use Core\BoundedContext\UserManagement\InfrastructureLayer\Services\SmsCodeSender;
use Core\BoundedContext\UserManagement\InfrastructureLayer\Services\WhatsAppCodeSender;
use Illuminate\Support\ServiceProvider;

class SenderCodeOtpServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // SMS para reset por teléfono
        $this->app->when(RequestPasswordResetBySMSPostController::class)
            ->needs(CodeSenderInterface::class)
            ->give(SmsCodeSender::class);

        // Email para reset por email
        $this->app->when(RequestPasswordResetByEMAILPostController::class)
            ->needs(CodeSenderInterface::class)
            ->give(EmailCodeSender::class);

        // WhatsApp para reset por WhatsApp
        $this->app->when(RequestPasswordResetByWhatsAppPostController::class)
            ->needs(CodeSenderInterface::class)
            ->give(WhatsAppCodeSender::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
