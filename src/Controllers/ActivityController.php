<?php

namespace App\Controllers;

use App\Ams\Core\Lib\Rest;
use App\Controllers\Controller;
use App\Models\Activity;

class ActivityController extends Controller 
{
    
    public function index()
    {
        $res = (new Activity())->getActivity(1);
        
        if ( $res ) {
            Rest::response( $res, 200 );
            return;
        }
        Rest::response( null, 204 );
        return;
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
