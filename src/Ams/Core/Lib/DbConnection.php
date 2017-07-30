<?php

namespace App\Ams\Core\Lib;
/**
 * DB Connection (Singleton)
 */
class DbConnection 
{
    private static $instance;
    private $dbConnection;
    
    private function __construct()
    {
        $config = self::getDbConfig()['db'];
        $connection = "mysql:host={$config['HOST_NAME']};dbname={$config['DATABASE']};";
        
        $this->dbConnection = new \PDO( 
                $connection, 
                $config['USERNAME'], 
                $config['PASSWORD'], 
                array( \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$config['CHARSET']}" ) 
        );
        $this->dbConnection->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );                
    }

    public static function getInstance()
    {
        if ( is_null( self::$instance ) ) {
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance->dbConnection;
    }
    /**
     * Get DB Connection
     * 
     * @return DbConnection
     */
    public static function getDbConnection()
    {
        try {
            $db = self::getInstance();
            
        } catch ( \Exception $ex ) {
            die( $ex );
        }
        return $db;
    }
    /**
     * Return DB Config
     * 
     * @return array
     */
    protected static function getDbConfig() : array
    {
        return require CONFIG_DIRECTORY . '/db.config.php';
    }
    
    private function __wakeup() {}
    // Cannot clone a singleton
    private function __clone() {}
}
