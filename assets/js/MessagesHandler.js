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
            
        } else if ( data['responseJSON'] != undefined ) {
            // Error
            messages.showMessage( 'error', data['responseJSON']['message'] );
            
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
        // Hide Modal if it exists
        if ( $globals.modal ) {
            $globals.modal.hide();
        }

    },
    error: function( message ) {

//        UIkit.notification({
        UIkit.notify({
            message: "<span uk-icon='icon: close'></span>" + message,
            status: 'danger',
            pos: 'top-center',
            timeout: 3000
        });
        return false;
    }
}
