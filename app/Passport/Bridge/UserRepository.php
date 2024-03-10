<?php
/**
 * Created by xuchengliang
 * Date: 2024/3/9 18:36
 */

namespace App\Passport\Bridge;

use RuntimeException;
use Laravel\Passport\Bridge\User;
use League\OAuth2\Server\Entities\ClientEntityInterface;

class UserRepository extends \Laravel\Passport\Bridge\UserRepository
{
    public function getUserEntityByUserCredentials($username, $password, $grantType, ClientEntityInterface $clientEntity)
    {
//        $provider = config('auth.guards.api.provider');

        $model = config('admin.auth.providers.teacher.model');

//        if (is_null($model = config('auth.providers.'.$provider.'.model'))) {
//            throw new RuntimeException('Unable to determine authentication model from configuration.');
//        }

        if (method_exists($model, 'findForPassport')) {
            $user = (new $model)->findForPassport($username);
        } else {
            $user = (new $model)->where('email', $username)->first();
        }

        if (! $user) {
            return;
        } elseif (method_exists($user, 'validateForPassportPasswordGrant')) {
            if (! $user->validateForPassportPasswordGrant($password)) {
                return;
            }
        } elseif (! $this->hasher->check($password, $user->getAuthPassword())) {
            return;
        }

        return new User($user->getAuthIdentifier());
    }

}