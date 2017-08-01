<?php

namespace App\Models;

use App\Models\Model;
use App\Ams\Core\Lib\Rest;
use App\Ams\Core\Lib\Request;

class Activity extends Model
{
    public static $STATE = [ 1 => 'Ativo', 0 => 'Inativo'];
    // Required fields
    protected $required = ['name'=>'max:255','description'=>'max:600','start_date','status','state'];
    // Relations
    protected $relations = [
        'status' => [\App\Models\Status::class, 'id', 'status']
    ];
    const FORBIDDEN_STATUS = 4;
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
        $status = Request::input('status');
        $state = Request::input('state');

        Activity::with(['status']);
        Activity::select( "*, DATE_FORMAT(start_date, '%d/%m/%Y') as start_date, DATE_FORMAT(end_date, '%d/%m/%Y') as end_date" );
        
        if ( isset( $status ) && ! is_null( $status ) && $status !== '' ) 
            Activity::where([ 'status', '=', $status ]);

        if ( isset( $state ) && ! is_null( $state ) && $state !== '' ) 
            Activity::where([ 'state', '=', $state ]);
        
        return Activity::execute();
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
    /**
     * Verify if it is possible to update activity.
     * 
     * @param int $id
     * @return boolean
     */
    public function canSave( int $id ) 
    {
        $activity = Activity::find( $id );
        if ( (int) $activity['status'] === (int) Activity::FORBIDDEN_STATUS ) {
            Rest::response( [], 400, "Status Concluído. Não é possível alterar a atividade." );
        }
        return true;
    }
}
