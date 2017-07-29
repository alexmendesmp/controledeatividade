<?php

namespace App\Ams\Core\Lib;

class Rest 
{
    const HTTP_CODE = [
        200 => 'OK',
        201 => 'Created',
        204 => 'No Content',
        400 => 'Bad Request',
        404 => 'Not Found',
        500 => 'Internal Server Error'
    ];
    
    public static function response( $data = null, $code = null )
    {
        $responseMessage = ( is_null( $code ) ) ? static::HTTP_CODE['200'] : $code;
        // Parse data
        $parsedData = static::parseData( $data );
        // Set http rsponse code
        http_response_code( $code );
        
        echo $parsedData;
        
    }
    /**
     * Parse data to JSON 
     * 
     * @param type $data
     * @return string
     */
    public static function parseData( $data = null ) : string
    {
        // No data is passed. So return empty string
        if ( is_null( $data ) ) {
            return "";
        }
        if ( ! is_array( $data ) && ! is_object( $data ) ) {
            // ..
            if ( is_array( $data ) ) {
                // ..
                $data = (object) $data;
            }
            // Data is not and array nor object
            // Cast it to array
            $data = (object) $data;
        }
        return json_encode( $data );
    }
}
