<?php

require 'routes/web.php';

use App\Ams\Core\Lib\MainController;
use App\Ams\Core\Lib\Request;

class Init 
{
    protected $frontController;
    protected $request;
    /**
     * Constructor
     */
    public function __construct() 
    {
        $this->frontController = new MainController();
        $this->request = new Request();
        $this->init();
        exit();
    }
    /**
     * Init
     */
    public function init()
    {
        $this->request->getPostData();
        $this->frontController->getCurrentRoute();
        $this->frontController->callControllerAction();
        
        
    }
    
}
