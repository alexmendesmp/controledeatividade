<?php

namespace App\Ams\Core\Lib;

class MainController 
{
    protected $server;
    protected $currentRoute;
    protected $httpMethod;
    
    protected $currentController;
    protected $currentAction;
    protected $currentParams;
    
    public function __construct()
    {
        $this->server = $_SERVER;
    }
    
    public function callControllerAction()
    {
        $classController = '\\App\\Controllers\\' . $this->currentController;
        $controller = new $classController();
        $action = $this->currentAction;
        $controller->$action(...$this->currentParams);
    }
    
    public function getCurrentRoute()
    {
        $httpMethod = $this->server['REQUEST_METHOD'];
        $routes = Route::getRouteCollection()[$httpMethod];
        $pathInfo = $this->server['PATH_INFO'];
        
        
        foreach ( $routes as $route => $controllerAction ) {
            // ..
            $replacement = '(\w+)\/?';
            $regex = '/(:\w+)\/?/';
            
            preg_match_all( $regex, str_replace('/', '\/', $route), $matches );
            
            $new = preg_replace( $regex, $replacement, str_replace('/', '\/', $route) );
            $newRegex = "/{$new}/";
            
            if ( preg_match( $newRegex, $pathInfo, $matches ) > 0 ) {
                // ..
                $this->currentController = $controllerAction['controller'];
                $this->currentAction = $controllerAction['action'];
                $this->currentParams = [$matches[1]];
            }
        }
        
    }
}
