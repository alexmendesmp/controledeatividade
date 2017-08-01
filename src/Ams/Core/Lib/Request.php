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

    public static function input( string $input = null ) 
    {
        $allInputs = [];

        if ( is_null( $input ) ) {
            // .. return all input from GET
            foreach ( $_GET as $index => $value ) {
                // ..
                $in = filter_input( INPUT_GET, $index );
                $allInputs = array_merge( $allInputs, [$index => $in] );
            }
            return $allInputs;

        } else {
            // Get only specific input
            return filter_input( INPUT_GET, $input );
        }
    }
}
