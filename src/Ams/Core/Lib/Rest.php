<?php

namespace App\Ams\Core\Lib;

class Rest 
{
    const HTTP_CODE = [
        200 => 'Operação realizada com sucesso.',
        201 => 'Item criado com sucesso',
        204 => 'Sem conteúdo',
        400 => 'Requisição incorreta',
        404 => 'Não encontrado',
        500 => 'Erro interno'
    ];
    
    public static function response( $data = null, $code = null, string $message = "" )
    {
        $responseMessage = ( is_null( $code ) ) ? static::HTTP_CODE['200'] : $code;
        // Parse data
        //$parsedData = static::parseData( $data );
        // Set http rsponse code
        $code = is_null( $code ) ? http_response_code() : $code;
        http_response_code( $code );
        
        $response['data'] = $data;
        $response['message'] = $message;
        if ( $code >= 400 ) {
            $response['error'] = true;
        }
        echo static::parseData( $response );
        
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
        return json_encode( $data, null, 5 );
    }
}
