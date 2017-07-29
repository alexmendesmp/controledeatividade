<?php

namespace App\Ams\Core\Lib;

use App\Ams\Core\Lib\DbConnection;

class ModelLib 
{
    /**
     * Table name
     * @var string
     */
    protected $table;
    /**
     * Fields to be retrieved from table
     * @var string
     */
    private $select;
    /**
     * Conditions
     * @var array
     */
    private $where = [];
    /**
     * DB Instance
     * @var DB
     */
    private $db;
    
    protected $relations = [];
    private $with;
    
    /**
     * Contructor
     */
    public function __construct()
    {
        $this->setTableName();
        $this->db = DbConnection::getDbConnection();

    }
    /**
     * Get All
     * 
     * @param string $params
     * @return
     */
    public function all( string $params = null )
    {
        // Before Find.
        $params = $this->beforeFind( $params );
        
        $fields = '*';
        if ( is_string( $params ) && ! empty( $params ) ) {
            // ..
            $fields = $params;
        }
        $query = "SELECT {$fields} FROM {$this->table}";
        $prepare = $this->db->prepare( $query );
        $prepare->execute();
        $result = $prepare->fetchAll( \PDO::FETCH_ASSOC );
        // Do all relations
        $this->doRelations( $result );
        
        $result = $this->afterFind( $result );
        
        return $result;
    }
    public function find( int $id, string $params = null )
    {
        // Before Find.
        $params = $this->beforeFind( $params );
        
        $fields = '*';
        if ( is_string( $params ) && ! empty( $params ) ) {
            // ..
            $fields = $params;
        }
        $query = "SELECT {$fields} FROM {$this->table} WHERE id = :id";
        $prepare = $this->db->prepare( $query );
        $prepare->bindValue( ':id', $id );
        $prepare->execute();
        $result = $prepare->fetch( \PDO::FETCH_ASSOC );
        
        $result = $this->afterFind( $result );
        
        return $result;
    }
    public function save()
    {
        return;
    }
    /**
     * Set Table name
     * 
     * @return
     */
    private function setTableName() 
    {
        if ( ! $this->table ) {
            // ..
            $classname = explode( '\\', get_class( $this ) );
            $this->table = strtolower( array_slice( $classname, -1, 1 )[0] );
        }
    }
    /**
     * Set fields to be retrieved from table
     * 
     * @param string $param
     * @return $this
     */
    public function select( string $param ) 
    {
        $this->select = $param;
        
        return $this;
    }
    /**
     * Set conditions to be applied in query
     * 
     * @param array $param
     * @return $this
     */
    public function where( array $param )
    {
        array_push( $this->where, $param );
        
        return $this;
    }
    /**
     * Set relations var
     * 
     * @param array $relations
     * @return $this
     */
    public function with( array $relations )
    {
        $this->with = $relations;
        
        return $this;
    }
    /**
     * Do all relations related to the model
     * 
     * @param array $results
     * @return array
     */
    private function doRelations( &$results )
    {
        if ( ! $this->with ) {
            return;
        }
        // Iterate
        foreach ( $this->with as $with ) {
            // ..
            $relation = $this->relations[$with];
            // 0 = class name
            // 1 = fk
            // 2 = local reference to fk
            foreach ( $results as $key => $item ) {
                // ..
                $s = new $relation[0]; // class
                $related = $s->find( $item[$relation[2]] ); // fk
//                $item[$relation[2]] = $related; //fk
                $results[$key][$relation[2]] = $related; //fk
            }
        }        
    }

    public function beforeFind( $params )
    {
        return $params;
    }
    public function afterFind( $result )
    {
        return $result;
    }
    
}
