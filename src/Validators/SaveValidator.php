<?php

namespace App\Validators;

use App\Ams\Core\Lib\Validator;
use App\Ams\Core\Lib\Rest;

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
        foreach ( $requiredFields as $key => $field ) {
            // ..
            if ( is_string($key) ) {
                // Ex: array( 'name'=>'max:255' )
                $rule = $field;
                $field = $key;
            }
            if ( ! array_key_exists( $field, $requestData ) ) {
                // ..
                array_push( $fieldsNotFound, $field );
            } else {
                // Verify whether field is empty
                if ( $requestData[$field] === '' ) {
                    // Required field cannot be empty
                    array_push( $fieldsNotFound, $field );
                } else {
                    // if field has rules
                    if (  $rule ) {
                        // Apply rules!
                        $maxlen = (int) explode(':', $rule)[1];
                        if ( strlen( $field ) > $maxlen ) {
                            array_push( $fieldsNotFound, $field );
                        }
                    }
                }
            }
        }
        
        if ( $fieldsNotFound ) {
            // There are required fields not found in request data
            Rest::response( [], 400,  "Campos que precisam de atenção: " . join( ', ', $fieldsNotFound ) );
        }
        return $requestData;
    }
        
}
