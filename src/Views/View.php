<?php

namespace App\Views;

class View 
{
    public static function render( string $view, $data = null )
    {
        echo $data;
    }
}
