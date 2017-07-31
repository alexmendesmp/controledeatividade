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
    /**
     *
     * @var array
     */
    protected $required;
    
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
    public function first()
    {
        return $this->execute( "LIMIT 1", true );
    }
    /**
     * Execute 'QueryBuilder'
     * 
     * @return type
     */
    public function execute( string $param = "", $first = false )
    {
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
                $query = "SELECT {$fields} FROM {$this->table} WHERE 1 {$conditions} $param";

                $prepare = $this->db->prepare( $query );
                $prepare->bindValue( ":$where[0]", $where[2] );
            }
        }
        
        $prepare->execute();
        // Fetch result
        if ( $first ) $result = $prepare->fetch( \PDO::FETCH_ASSOC );
            else $result = $prepare->fetchAll( \PDO::FETCH_ASSOC );
        
        if ( ! $result ) 
            return;
        
        // Do all relations
        $this->doRelations( $result );
        
        $result = $this->afterFind( $result );
        
        return $result;
    }
    /**
     * Save 
     * 
     * @param array $postData
     * @return
     */
    public function save( array $postData )
    {
        // Do Before Save
        $postData = $this->beforeSave( $postData );
        try {
            $fields = "(NAME,DESCRIPTION,START_DATE,END_DATE,STATUS,STATE)";
            $values = "(:name,:description,:start_date,:end_date,:status,:state)";
            $query = "INSERT INTO {$this->table} {$fields} VALUES {$values}";
            $prepare = $this->db->prepare( $query );
            $prepare->execute([
                ':name'         => $postData['name'],
                ':description'  => $postData['description'],
                ':start_date'   => $postData['start_date'],
                ':end_date'     => $postData['end_date'],
                ':status'       => $postData['status'],
                ':state'        => $postData['state']
            ]);
            if ( $this->db->lastInsertId() ) {
                // ..
                $newlyRecorded = $this->find( $this->db->lastInsertId() );
                return $newlyRecorded;
            }
        } catch ( \PDOException $ex ) {
            
            die( $ex->getMessage() );
        }
        return;
    }
    /**
     * Update
     * 
     * @param array $postData
     * @return
     */
    public function update( int $id, array $postData )
    {
        // Do Before Save
        $postData = $this->beforeSave( $postData );
        try {
            $fields = "NAME=:name,DESCRIPTION=:description,START_DATE=:start_date,END_DATE=:end_date,STATUS=:status,STATE=:state";
            $query = "UPDATE {$this->table} SET {$fields} WHERE id = :id";
            $prepare = $this->db->prepare( $query );
            $prepare->execute([
                ':id'           => $id,
                ':name'         => $postData['name'],
                ':description'  => $postData['description'],
                ':start_date'   => $postData['start_date'],
                ':end_date'     => $postData['end_date'],
                ':status'       => $postData['status'],
                ':state'        => $postData['state']
            ]);
            $updatedRecorded = $this->find( $id );
            return $updatedRecorded;
            
        } catch ( \PDOException $ex ) {
            
            die( $ex->getMessage() );
        }
        return;
    }
    /**
     * Delete
     * 
     * @param int $id
     * @return
     */
    public function delete( int $id )
    {
        try {
            $query = "DELETE FROM {$this->table} WHERE id = :id";
            $prepare = $this->db->prepare( $query );
            $prepare->execute([':id' => $id ]);
            
            return true;
            
        } catch ( \PDOException $ex ) {
            
            //die( $ex->getMessage() );
            return false;
        }
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
                // It is a collection
                // So, iterate
                $s = new $relation[0]; // class
                $related = $s->find( $item[$relation[2]] ); // fk
                $results[$key][$relation[2]] = $related; //fk
            }
        }        
    }
    /**
     * Return required fields
     * 
     * @return array
     */
    public function getRequiredFields() : array
    {
        return $this->required;
    }

    public function beforeFind( $params )
    {
        return $params;
    }
    public function afterFind( $result )
    {
        return $result;
    }
    public function beforeSave( $params )
    {
        return $params;
    }
    public function afterSave( $result )
    {
        return $result;
    }
    
}
