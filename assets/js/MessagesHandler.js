/***********************************************************************
 * MESSAGES 
 **********************************************************************/
var messages = {
    // Handle status message
    handler: function ( data ) {
        // handle
        if ( data['error'] != undefined ) {
            // Error
            messages.showMessage( 'error', data['message'] );
        } else {
            // Success
            messages.showMessage( 'success', data['message'] );
        }
    },
    showMessage: function( messageType, message ) {
        // ..
        messages[messageType]( message );
    },
    hideMessage: function( placeholder )
    {
        placeholder.hide();
    },
    // Success
    success: function( message ) {

        var placeholder = $( "#statusMessage" );
        placeholder.addClass( 'alert-success' );
        placeholder.html( message );
        placeholder.show();
        setTimeout(function(){
            messages.hideMessage( placeholder );
        },3000);
        // Emit Event
        $(document).trigger( "httpResponseOk" );

    },
    error: function( data ) {
        var placeholder = $( "#statusMessage" );
        placeholder.addClass( 'alert-success' );
        placeholder.html( message );
        placeholder.show();
        setTimeout(function(){
            messages.hideMessage( placeholder );
        }, 3000);
        // Emit Event
        $(document).trigger( "httpResponseOk" );
    }
}
