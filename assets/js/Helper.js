/************************************************************************
 * Build Activity list
 ***********************************************************************/
var Helper = {
    // Activities List Builder
    buildActivitiesList: function( list ) {
        // ..
        if ( list == undefined ) {
            var list = {};
            list.data = null;
        }
        var state = {1: 'Ativo', 0: 'Inativo'};
        var data = list.data;
        var activityList = $("#activityList");
        var STATUS_DONE = 4;
        var bgcolor = "";

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
            // Check status
            bgcolor = "";
            var status = parseInt(item['status']['id']);
            if ( status == STATUS_DONE ) {                
                bgcolor = "#FFEEEE";
            }
            // create element
            var tr = $("<tr/>", {bgcolor});
            tr.append( $("<td/>").html(item['id']) );
            tr.append( $("<td/>").html(item['name']) );
            tr.append( $("<td/>").html(item['description']) );
            tr.append( $("<td/>").html(item['start_date']) );
            tr.append( $("<td/>").html(item['end_date']) );
            tr.append( $("<td/>").html(item['status']['description']) );
            tr.append( $("<td/>").html(state[item['state']]) );
            tr.append( 
                    $("<td/>").append( 
                        $("<div/>", { 'class':'btn-group', 'role': 'group' })
                            .append( $("<a/>", {'href':'#', 'class':'actionButton', 'data-type': 'edit', 'data-id': item['id'], 'style': 'margin-right:5px'} )
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
    }, // function
    
    /************************************************************************
     * Open Modal
     ***********************************************************************/    
    openModal : function( selector, callback ){
        // Show Modal
        $globals.modal = UIkit.modal( selector );
        $globals.modal.show();
        
        $globals.modal.on({
            'hide.uk.modal': function(){
                if ( $.isFunction( callback ) ) {
                    // ..
                    callback();
                }
            }
        });
        
    }, // function
    
    /************************************************************************
     * Build Select
     ***********************************************************************/    
    buildSelect: function( label, fieldToCompare, selector, options, data ) {
        // ..
        $globals.SelectedInCreateMode = 'SELECTED';
        
        $.map( options, function( option ){
            $globals.itemSelected = '';
            
            if ( data != undefined ) {
                // Select stored option
                if ( parseInt(data[fieldToCompare]) == parseInt(option['id']) ) {
                    $globals.itemSelected = 'SELECTED';
                    $globals.SelectedInCreateMode = '';
                }
            }
            // Build options list
            selector.append( 
                    $("<option "+$globals.itemSelected+" value='"+option['id']+"'></option>")
                        .html( option['description'] )
                    );
        });
        selector.prepend( $("<option "+$globals.SelectedInCreateMode+" value=''></option>").html( label + "...") );
        
        delete $globals.itemSelected;
        delete $globals.SelectedInCreateMode;
        
    }
}