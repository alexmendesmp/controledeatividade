<?php

namespace App\Controllers;

use App\Ams\Core\Lib\Rest;
use App\Controllers\Controller;
use App\Models\Activity;

class ActivityController extends Controller 
{
    
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
        return;
    }
    public function update()
    {
        
    }
    public function delete()
    {
        
    }
    
    
}
