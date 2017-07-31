<?php

namespace App\Controllers;

use App\Ams\Core\Lib\Rest;
use App\Controllers\Controller;
use App\Models\Activity;
use App\Ams\Core\Lib\Request;
use App\Views\View;

class ActivityController extends Controller 
{
    public function main() 
    {
        $data = (new Activity)->getActivityList();
        (new View)->render( 'main', $data );
    }
    /**
     * List All Activity
     * 
     * @return type
     */
    public function index()
    {
        $res = (new Activity())->getActivityList();
        
        if ( $res ) {
            Rest::response( $res, 200 );
            return;
        }
        Rest::response( null, 204 );
        return;
    }
    /**
     * Show Activity by ID
     * 
     * @param type $id
     * @return type
     */
    public function show( $id )
    {
        $res = (new Activity())->getActivity( $id );
        
        if ( $res ) {
            Rest::response( $res, 200 );
            return;
        }
        Rest::response( null, 204 );
        return;
    }
    /**
     * 
     * @return type
     */
    public function save()
    {
        $request = Request::getAll();
        $saved = (new Activity)->saveActivity( $request );
        if ( $saved ) {
            return Rest::response( $saved, 201, "Atividade criada com sucesso." );
        }
        return Rest::response( [], 400, "Erro ao criar atividade" );
    }
    /**
     * 
     * @param type $id
     * @return
     */
    public function update( $id )
    {
        $request = Request::getAll();
        if ( ! $request ) {
            return Rest::response( [], 400, "Erro ao editar atividade" );
        }
            
        $updated = (new Activity)->updateActivity( $id, $request );
        
        if ( $updated ) {
            return Rest::response( $updated, 200, "Atividade atualizada com sucesso." );
        }
        return Rest::response( [], 400, "Erro ao editar atividade" );
    }
    /**
     * 
     * @param type $id
     * @return
     */
    public function delete( $id )
    {
        $deleted = (new Activity)->deleteActivity( $id );
        if ( $deleted ) {
            return Rest::response( [], 200, 'Atividade deletada com sucesso.' );
        }
        return Rest::response( [], 400, 'Erro ao deletar atividade.' );
    }
    
    
}
