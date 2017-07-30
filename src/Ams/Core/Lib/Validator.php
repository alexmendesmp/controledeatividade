<?php

namespace App\Ams\Core\Lib;

interface Validator 
{
    public static function validate( array $requestData, array $otherParams );
}
