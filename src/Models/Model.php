<?php

namespace App\Models;

use App\Ams\Core\Lib\ModelLib;
use App\Validators\SaveValidator;

class Model extends ModelLib
{
    public function beforeSave($params) 
    {
        parent::beforeSave($params);
        
        if ( ! SaveValidator::validate( $params, $this->getRequiredFields() ) ) {
            // ..
            throw new Exception( 'Validator Error' );
        }
        return $params;
    }
}
