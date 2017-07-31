<?php

namespace App\Models;

use App\Models\Model;

class Activity extends Model
{
    public static $STATE = [ 1 => 'Ativo', 0 => 'Inativo'];
    // Required fields
    protected $required = ['name'=>'max:255','description'=>'max:600','start_date','status','state'];
    // Relations
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
                ->select( "*, DATE_FORMAT(start_date, '%d/%m/%Y') as start_date, DATE_FORMAT(end_date, '%d/%m/%Y') as end_date" )
                ->first();
    }
    /**
     * Get List of Activities
     * 
     * @return type
     */
    public function getActivityList()
    {
        return Activity::with(['status'])
                ->select( "*, DATE_FORMAT(start_date, '%d/%m/%Y') as start_date, DATE_FORMAT(end_date, '%d/%m/%Y') as end_date" )
                ->execute();
    }
    /**
     * Save an Activity
     * 
     * @param array $postData
     * @return
     */
    public function saveActivity( array $postData )
    {
        return Activity::save( $postData );
    }
    /**
     * Update an Activity
     * 
     * @param int $id
     * @param array $postData
     * @return
     */
    public function updateActivity( int $id, array $postData )
    {
        return Activity::update( $id, $postData );
    }
    /**
     * Delete an Activity
     * 
     * @param int $id
     * @return
     */
    public function deleteActivity( int $id ) 
    {
        return Activity::delete( $id );
    }
}
