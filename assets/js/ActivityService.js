/***********************************************************************
 * HTTP SERVICES 
 **********************************************************************/
var ActivityService = function()
{
    return {
        delete: function( id, callBack ) {

            HttpService().request( 'activity/' + id, 'DELETE', callBack )
        },
        get: function( id, callBack ) {

            console.log( 'get' )
        },
        list: function( callBack ) {

            HttpService().request( 'activity', 'GET', callBack )
        },
        save: function() {

            console.log( 'save' )
        },
        update: function( id, callBack ) {

            UIkit.modal( "#modalCreateUpdate" ).show();
        }
    }
}

// AJAX
var HttpService = function( data ) 
{
    // validate data content
    data = ( data === 'undefined' ) ? null : data;
    return {
        request: function( service, httpMethod, callBack ) {
            // Request
            $.ajax({
                url: 'index.php/' + service,
                data: data,
                dataType: 'json',
                method: httpMethod,
                success: function( result ) {
                    // Success
                    if ( $.isFunction( callBack ) ) {
                        // Execute callback function
                        callBack( result );
                    }
                }
            });
        }
    }
}

