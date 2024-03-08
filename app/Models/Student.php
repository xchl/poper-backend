<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use SMartins\PassportMultiauth\HasMultiAuthApiTokens;


class Student extends Authenticatable
{
    use HasMultiAuthApiTokens;
}
