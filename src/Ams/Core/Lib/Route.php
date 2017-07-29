<?php

namespace App\Ams\Core\Lib;

class Route 
{
    protected static $ROUTE_COLLECTION = [];
    /**
     * 
     * @param string $regx
     * @param string $controllerAction
     * @param string $httpMethod
     */
    public static function set( string $regx, string $controllerAction, string $httpMethod )
    {
        $controllerAction = self::getControllerAction( $controllerAction );
        if ( $regx ) {
            // ..
            static::$ROUTE_COLLECTION = array_merge( 
                    static::$ROUTE_COLLECTION, [$regx => $controllerAction] 
            );
        }
    }
    /**
     * Split given string into Controller / Action
     * 
     * @param string $controllerAction
     * @return array
     */
    public static function getControllerAction( string $controllerAction ) : array
    {
        if ( strstr( $controllerAction, '@' ) ) {
            list( $controller, $action ) = explode( '@', $controllerAction );
            return compact( 'controller', 'action' );
        }
        return [];
        
    }
    /**
     * Return array of routes
     * 
     * @return array
     */
    public static function getRouteCollection() : array
    {
        return static::$ROUTE_COLLECTION;
    }
}
