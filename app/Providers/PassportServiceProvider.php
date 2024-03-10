<?php
/**
 * Created by xuchengliang
 * Date: 2024/3/10 14:07
 */

namespace App\Providers;

use App\Passport\CryptKey;
use Laravel\Passport\Passport;
use Laravel\Passport\PassportServiceProvider as BasePassportServiceProvider;

class PassportServiceProvider extends BasePassportServiceProvider
{
    /**
     * Create a CryptKey instance without permissions check
     *
     * @param string $key
     */
    protected function makeCryptKey($key)
    {
        return new CryptKey(
            'file://'.Passport::keyPath($key),
            null,
            false
        );
    }

}