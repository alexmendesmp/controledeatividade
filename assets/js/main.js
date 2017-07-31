
var  $globals = {};


jQuery(document).ready( function( $ ){

    "use strict";
    
    $globals.state = 'save';
        
    // Event Click Handler
    $( document ).on( "click", 'a.actionButton', function( event )
    {
        var eventType = $(this).data( 'type' );
        var activityId = $(this).data( 'id' );
        // Call action event
        callEvent[eventType]( activityId );
    });
    // Actions
    var callEvent = {
        // DELETE
        delete: function ( id ) {
            // Do delete
            UIkit.modal.confirm( "Tem certeza que deseja excluir esta atividade?", 
            function(){
                    ActivityService().delete( id, messages.handler );
            });
            // on Event
            $(document).on( 'httpResponseOk', function( event ){
                callEvent.list();
            });
        },
        // UPDATE
        update: function ( id ) {
            // Do Update
            ActivityService().update( id );
        },
        // Enter Edit 
        edit: function ( id ) {
            // Set Activity STATE
            $globals.state = 'update';
            // Do Edit
            ActivityService().edit( id, bindFormData );
        },
        // LIST
        list: function () {
            // ..
            ActivityService().list( buildList );
        }
    };
    // Call List
    callEvent.list();
    
    // One Way bind.
    var bindFormData = function ( data ) {
        // ..
        var d = data['data'];
        $("#name").val( d['name'] );
        $("#description").val( d['description'] );
        $("#start_date").val( d['start_date'] );
        $("#end_date").val( d['end_date'] );
        UIkit.modal( "#modalCreateUpdate" ).show();
    }
    
    
});