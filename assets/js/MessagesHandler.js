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

//        UIkit.notification({
        UIkit.notify({
            message: "<span uk-icon='icon: check'></span>" + message,
            status: 'success',
            pos: 'top-center',
            timeout: 3000
        });
        // Emit Event
        $(document).trigger( "httpResponseOk" );

    },
    error: function( data ) {

//        UIkit.notification({
        UIkit.notify({
            message: "<span uk-icon='icon: close'></span>" + message,
            status: 'danger',
            pos: 'top-center',
            timeout: 3000
        });
        // Emit Event
        $(document).trigger( "httpResponseOk" );
    }
}
