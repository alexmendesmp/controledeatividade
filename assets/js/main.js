
var  $globals = {};


jQuery(document).ready( function( $ ){

    "use strict";
    
    $globals.state = 'save';
    $globals.isActivityDone = false;
    $globals.currentEdit_ID = undefined;
    $globals.modal = undefined;
        
    // Event Click Handler
    $( document ).on( "click", '.actionButton', function( event )
    {
        var eventType = $(this).data( 'type' );
        var activityId = ($(this).data( 'id' )) ? $(this).data( 'id' ) : $globals.currentEdit_ID;
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
            // on httpResponseOk Event
            $(document).on( 'httpResponseOk', function(){
                callEvent.activitieslist();
            });
        },
        // SAVE / UPDATE
        save: function ( id ) {
            var data = getFormData();
            // Do
            if ( $globals.state == 'update' ) {
                // Update
                ActivityService().update( data, id, messages.handler );
                
            } else if ($globals.state == 'save') {
                // Save
                ActivityService().save( data, messages.handler );
            }
            // on httpResponseOk Event
            $(document).on( 'httpResponseOk', function(){
                callEvent.activitieslist();
            });
        },
        // Enter Edit 
        edit: function ( id ) {
            // Set Activity STATE
            $globals.state = 'update';
            // Do Edit
            ActivityService().edit( id, bindFormData );
        },
        // Enter create mode
        create: function ( id ) {
            // Set Activity STATE
            $globals.state = 'save';
            // Do Edit
            Helper.openModal( "#modalCreateUpdate", cleanupFormData );
            // Get status list
            statusList();
        },
        // LIST
        activitieslist: function () {
            // ..
            ActivityService().list( Helper.buildActivitiesList );
        },
        // LIST
        getStatus: function () {
            // ..
            ActivityService().getStatus( buildList );
            // on httpResponseOk Event
            $(document).on( 'httpResponseOk', function(){
                callEvent.activitieslist();
            });
        }
    };
    // Call List
    callEvent.activitieslist();
    
    // One Way bind.
    var bindFormData = function ( data ) {
        // Set Activity state
        $globals.state = 'update';
        // Get data
        var d = data['data'];
        $("#name").val( d['name'] );
        $("#description").val( d['description'] );
        $("#start_date").val( d['start_date'] );
        $("#end_date").val( d['end_date'] );
        d.statusId = d['status']['id'];
        
        statusList( d );
        
        // Set Current Edit ID
        $globals.currentEdit_ID = d['id'];
        // Open Modal
        Helper.openModal( "#modalCreateUpdate", cleanupFormData );
    }
    
    var getFormData = function( id )
    {
        var activity = {
            'name': $("#name").val(),
            'description': $("#description").val(),
            'start_date': $("#start_date").val(),
            'end_date': $("#end_date").val(),
            'status': $("#status").val(),
            'state': $("#state").val()
        }
        return activity;
    }
    var cleanupFormData = function()
    {
        $("#name").val('');
        $("#description").val('');
        $("#start_date").val('');
        $("#end_date").val('');
        $("#status").val('');
        $("#state").val('');
    }
    
        function statusList( data2 ) {
            
            ActivityService().getStatus(function( response ){
                // STATUS OPTIONS //
                var options = response['data'];
                var selectStatus = $("#status");
                $globals.itemSelected = '';
                selectStatus.html("");
                Helper.buildSelect( 'Status', 'statusId', selectStatus, options, data2 );

                // STATE OPTIONS //
                var states = [
                    { 'id': '1', 'description': 'Ativo' },
                    { 'id': '0', 'description': 'Inativo' }
                ];
                var selectState = $("#state");
                selectState.html("");
                Helper.buildSelect( 'Situação', 'state', selectState, states, data2 );
            });
        }
    
    
});