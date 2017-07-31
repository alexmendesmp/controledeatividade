<?php

namespace App\Models;

use App\Models\Model;

class Activity extends Model
{
    public static $STATE = [ 1 => 'Ativo', 0 => 'Inativo'];
    
    protected $required = ['name','description','start_date','end_date','status','state'];
            
    protected $relations = [
        'status' => [\App\Models\Status::class, 'id', 'status']
    ];
    /**
     * 
     * @param int $id
     * @param type $params
     * @return type
     */
    public function getActivity( int $id, $params = null )
    {
        return Activity::with(['status'])
                ->where([ 'id', '=', $id ])
                ->execute();
    }
    /**
     * 
     * @return type
     */
    public function getActivityList()
    {
        return Activity::with(['status'])->all();
    }
    
    public function saveActivity( array $postData )
    {
        return Activity::save( $postData );
    }
    
    public function updateActivity( int $id, array $postData )
    {
        return Activity::update( $id, $postData );
    }
    public function deleteActivity( int $id ) 
    {
        return Activity::delete( $id );
    }
}
