<?php

namespace App\Controllers;

use App\Ams\Core\Lib\Rest;
use App\Controllers\Controller;
use App\Models\Activity;
use App\Ams\Core\Lib\Request;

class ActivityController extends Controller 
{
    /**
     * List All Activity
     * 
     * @return type
     */
    public function index()
    {
        $res = (new Activity())->getActivityList();
        
        if ( $res ) {
            Rest::response( $res, 200 );
            return;
        }
        Rest::response( null, 204 );
        return;
    }
    /**
     * Show Activity by ID
     * 
     * @param type $id
     * @return type
     */
    public function show( $id )
    {
        $res = (new Activity())->getActivity( $id );
        
        if ( $res ) {
            Rest::response( $res, 200 );
            return;
        }
        Rest::response( null, 204 );
        return;
    }
    /**
     * 
     * @return type
     */
    public function save()
    {
        $request = Request::getAll();
        $saved = (new Activity)->saveActivity( $request );
        if ( $saved ) {
            return Rest::response( $saved, 201 );
        }
        return Rest::response( [], 400 );
    }
    /**
     * 
     * @param type $id
     * @return
     */
    public function update( $id )
    {
        $request = Request::getAll();
        $updated = (new Activity)->updateActivity( $id, $request );
        
        if ( $updated ) {
            return Rest::response( $updated, 200 );
        }
        return Rest::response( [], 400 );
    }
    /**
     * 
     * @param type $id
     * @return
     */
    public function delete( $id )
    {
        (new Activity)->deleteActivity( $id );
        return Rest::response( [], 200 );
    }
    
    
}
