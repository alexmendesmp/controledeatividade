
jQuery(document).ready( function( $ ){

    "use strict";
    
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
        delete: function ( id ) {
            // Do delete
            //UIkit.modal.confirm( "Tem certeza que deseja excluir esta atividade?" );
            ActivityService().delete( id, messages.handler );
            // on Event
            $(document).on( 'httpResponseOk', function( event ){
                callEvent.list();
            });
    

        },
        update: function ( id ) {
            // Do Edit
            ActivityService().update( id );
        },
        list: function () {
            // ..
            ActivityService().list( buildList );
        }
    };
    // Build Activity list
    var buildList = function( list ) {
        // ..
        var data = list.data;
        var activityList = $("#activityList");
        activityList.html("");

        var table = $("<tbody/>");
        table.append($("<th/>").html("#"));
        table.append($("<th/>").html("Nome"));
        table.append($("<th/>").html("Descrição"));
        table.append($("<th/>").html("Data de início"));
        table.append($("<th/>").html("Data de finalização"));
        table.append($("<th/>").html("Status"));
        table.append($("<th/>").html("Situação"));
        table.append($("<th/>").html("Ação"));
        
        $.map( data, function( item ){
            // create element
            var tr = $("<tr/>");
            tr.append( $("<td/>").html(item['id']) );
            tr.append( $("<td/>").html(item['name']) );
            tr.append( $("<td/>").html(item['description']) );
            tr.append( $("<td/>").html(item['start_date']) );
            tr.append( $("<td/>").html(item['end_date']) );
            tr.append( $("<td/>").html(item['status']['description']) );
            tr.append( $("<td/>").html(item['state']) );
            tr.append( 
                    $("<td/>").append( 
                        $("<div/>", { 'class':'btn-group', 'role': 'group' })
                            .append( $("<a/>", {'href':'#', 'class':'actionButton', 'data-type': 'delete', 'data-id': item['id']} )
                                .append( $("<span/>", {'class': 'glyphicon glyphicon-pencil', 'aria-hidden': 'true'} ))
                            )
                            .append( $("<a/>", {'href':'#', 'class':'actionButton', 'data-type': 'delete', 'data-id': item['id']} )
                                .append( $("<span/>", {'class': 'glyphicon glyphicon-trash', 'aria-hidden': 'true'} ))
                            )
                    ) 
            );
            table.append(tr);
            activityList.append( table )
        });
    }
    // Call List
    callEvent.list();
    
    
});