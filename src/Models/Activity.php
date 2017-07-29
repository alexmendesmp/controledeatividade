<?php

namespace App\Models;

use App\Models\Model;

class Activity extends Model
{
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
//        return Activity::with(['status'])->find( $id, $params );
        return Activity::where(['status', '=', 3])
                ->select( 'description' )
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
}
