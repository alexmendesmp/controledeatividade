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
        // Where Condition?
        
        $query = "SELECT {$fields} FROM {$this->table}";
        $prepare = $this->db->prepare( $query );
        $prepare->execute();
        // Fetch Results
        $result = $prepare->fetchAll( \PDO::FETCH_ASSOC );
        // Do all relations
        $this->doRelations( $result );
        
        $result = $this->afterFind( $result );
        
        return $result;
    }
    /**
     * 
     * @param int $id
     * @param string $params
     * @return type
     */
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
        // Fetch result
        $result = $prepare->fetch( \PDO::FETCH_ASSOC );
        // Do all relations
        $this->doRelations( $result );
        
        $result = $this->afterFind( $result );
        
        return $result;
    }
    /**
     * Execute 'QueryBuilder'
     * 
     * @return type
     */
    public function execute()
    {

        // Before Find.
//        $params = $this->beforeFind( $params );
//        
        $fields = '*';
        if ( $this->select ) {
            // ..
            $fields = $this->select;
        }
        
        $conditions = null;
        foreach ( $this->where as $logical => $wheres ) {
            // ..
            foreach ( $wheres as $where ) {
                // ..
                $conditions .= "{$logical} {$where[0]} {$where[1]} :{$where[0]}";
                $query = "SELECT {$fields} FROM {$this->table} WHERE 1 {$conditions}";

                $prepare = $this->db->prepare( $query );
                $prepare->bindValue( ":$where[0]", $where[2] );
            }
        }
        
        $prepare->execute();
        // Fetch result
        $result = $prepare->fetchAll( \PDO::FETCH_ASSOC );
        if ( ! $result ) 
            return;
        
        // Do all relations
        $this->doRelations( $result );
        
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
        if ( isset( $this->where['AND'] ) ) {
            // ..
            $this->where['AND'] = array_merge( $this->where['AND'], [$param] );
        }
        
        $this->where = array_merge( $this->where, ['AND' => [$param]] );
        
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
            if ( ! @is_array( $results[0] ) ) {
                // It is not a collection of arrays
                // but a single result
                $s = new $relation[0]; // class
                $related = $s->find( $results[$relation[2]] ); // fk
                $results[$relation[2]] = $related; //fk
                continue;
            }
            foreach ( $results as $key => $item ) {
                // ..
                $s = new $relation[0]; // class
                $related = $s->find( $item[$relation[2]] ); // fk
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
