<?php

namespace App\Ams\Core\Lib;

class Request 
{
    protected static $requestData;
    
    public function getAll()
    {
        return self::$requestData;
    }
    
    public function getPostData()
    {
        $raw = file_get_contents( "php://input" );
        if (  $json = json_decode( $raw, true ) ) {
            
            self::$requestData = $json;
            return true;
        }
        self::$requestData = [];
        return false;
        
    }
}
