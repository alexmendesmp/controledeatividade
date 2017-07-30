<?php

namespace App\Validators;

use App\Ams\Core\Lib\Validator;

class SaveValidator implements Validator
{
    /**
     * Validate entry
     * 
     * @param array $requestData
     * @param array $requiredFields
     * @return boolean
     * @throws \Exception
     */
    public static function validate( array $requestData, array $requiredFields )
    {
        // Fields not found
        $fieldsNotFound = [];
        // Iterate
        foreach ( $requiredFields as $field ) {
            // ..
            if ( ! array_key_exists( $field, $requestData ) ) {
                // ..
                array_push( $fieldsNotFound, $field );
            }
        }
        
        if ( $fieldsNotFound ) {
            // There are required fields not found in request data
            throw new \Exception( "Campos Requeridos: " . join( ', ', $fieldsNotFound ) );
        }
        return $requestData;
    }
        
}
