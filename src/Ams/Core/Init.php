<?php

require 'routes/web.php';

use App\Ams\Core\Lib\MainController;

class Init 
{
    protected $frontController;
    /**
     * Constructor
     */
    public function __construct() 
    {
        $this->frontController = new MainController();
        $this->init();
        exit();
    }
    /**
     * Init
     */
    public function init()
    {
        $this->frontController->getCurrentRoute();
        $this->frontController->callControllerAction();
    }
    
}
