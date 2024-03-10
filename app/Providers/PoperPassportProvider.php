<?php

namespace App\Providers;

use Laravel\Passport\Bridge\RefreshTokenRepository;
use App\Passport\Bridge\UserRepository;
use Laravel\Passport\Passport;
use Laravel\Passport\PassportServiceProvider;
use League\OAuth2\Server\Grant\PasswordGrant;

class PoperPassportProvider extends PassportServiceProvider
{

    protected function makePasswordGrant()
    {
        $grant = new PasswordGrant(
            $this->app->make(UserRepository::class),
            $this->app->make(RefreshTokenRepository::class)
        );

        $grant->setRefreshTokenTTL(Passport::refreshTokensExpireIn());

        return $grant;
    }
}
