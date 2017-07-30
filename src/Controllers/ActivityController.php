<?php

namespace App\Controllers;

use App\Ams\Core\Lib\Rest;
use App\Controllers\Controller;
use App\Models\Activity;

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
    public function save()
    {
        return Rest::response( ['message'=>'save'], 200 );
    }
    public function update()
    {
        return Rest::response( ['message'=>'update'], 200 );
    }
    public function delete()
    {
        return Rest::response( ['message'=>'delete'], 200 );
    }
    
    
}
