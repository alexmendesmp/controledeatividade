<?php

namespace App\Ams\Core\Lib;

class Request 
{
    protected static $requestData;
    
    public function getAll() : array
    {
        return self::$requestData;
    }
    
    public function getPostData()
    {
        $raw = file_get_contents( "php://input" );
        self::$requestData = json_decode( $raw, true );
    }
}
