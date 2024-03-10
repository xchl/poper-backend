<?php
/**
 * Created by xuchengliang
 * Date: 2024/3/10 14:18
 */

namespace App\Passport;

class CryptKey extends \League\OAuth2\Server\CryptKey
{
    public function __construct($keyPath, $passPhrase = null, $keyPermissionsCheck = true)
    {
        try {
            parent::__construct($keyPath, $passPhrase, $keyPermissionsCheck);

        }catch (\LogicException $exception){
            if(strpos($keyPath, 'public') !== false){
                $this->keyPath = config('passport.oauth_public_key');
            }
            if(strpos($keyPath, 'private') !== false){
                $this->keyPath = config('passport.oauth_private_key');
            }
            $this->passPhrase = $passPhrase;
        }
    }


}