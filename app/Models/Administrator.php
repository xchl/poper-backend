<?php
/**
 * Created by xuchengliang
 * Date: 2024/3/9 16:55
 */

namespace App\Models;

use SMartins\PassportMultiauth\HasMultiAuthApiTokens;

class Administrator extends \Encore\Admin\Auth\Database\Administrator
{
    use HasMultiAuthApiTokens;
    public $incrementing = false;
    public function findForPassport(string $username)
    {
        return $this->where('username', $username)->first();
    }


    public function getAuthIdentifier(){
        return $this->id;
    }

}