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
        }
        Rest::response( null, 204 );
    }
    public function show()
    {
        
    }
    public function save()
    {
        
    }
    public function update()
    {
        
    }
    public function delete()
    {
        
    }
    
    
}
