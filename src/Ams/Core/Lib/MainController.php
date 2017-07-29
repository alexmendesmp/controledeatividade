<?php

namespace App\Ams\Core\Lib;

class MainController 
{
    protected $server;
    protected $currentRoute;
    
    public function __construct()
    {
        $this->server = $_SERVER;
    }
    
    public function callControllerAction()
    {
        $controller = new \App\Controllers\ActivityController();
        $controller->index();
    }
    
    public function getCurrentRoute()
    {
        if ( isset( $this->server['PATH_INFO'] ) ) {
            // ..
            $pattern = '/\/?list\/?$/';
            $subject = 'list/';
            
            $preg = preg_match_all( $pattern, $subject, $matches );
        }
    }
}
