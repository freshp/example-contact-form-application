<?php declare(strict_types=1);

namespace FreshP\ContactFormApplication\ViewBuilder\Factories;

use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\NativeSessionTokenStorage;

class CsrfTokenFactory
{
    public static function create(): CsrfTokenManager
    {
        return (new CsrfTokenManager(new UriSafeTokenGenerator(), new NativeSessionTokenStorage()));
    }
}
