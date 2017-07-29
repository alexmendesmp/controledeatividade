<?php

namespace App\Models;

use App\Models\Model;

class Status extends Model
{
    /**
     * 
     * @param int $id
     * @param type $params
     * @return type
     */
    public function getStatus( int $id, $params = null )
    {
        return Status::find( $id, $params );
    }
    /**
     * 
     * @return type
     */
    public function getStatusList()
    {
        return Status::all();
    }
}
