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
        list: function( data, callBack ) {
            data = ( data === 'undefined' ) ? null : data;
            HttpService( data ).request( 'activity', 'GET', callBack )
        },
        save: function( data, callBack ) {

            HttpService(data).request( 'activity', 'POST', callBack );
        },
        update: function( data, id, callBack ) {
            
            HttpService(data).request( 'activity/' + id, 'PUT', callBack );
        },
        edit: function( id, callBack ) {

            HttpService().request( 'activity/' + id, 'GET', callBack );
        },
        getStatus: function( callBack ) {

            HttpService().request( 'status', 'GET', callBack );
        }
    }
}

// AJAX
var HttpService = function( data ) 
{
    var response;
    return {
        request: function( service, httpMethod, callBack ) {
            // validate data content
            if ( httpMethod != 'GET' )
                data = ( data === 'undefined' ) ? null : JSON.stringify( data );
            // Request
            $.ajax({
                url: 'index.php/' + service,
                data: data,
                contentType: 'raw',
                dataType: 'json',
                method: httpMethod,
                success: function( result ) {
                    // Success
                    if ( $.isFunction( callBack ) ) {
                        // Execute callback function
                        callBack( result );
                    }
                },
                statusCode: {
                    400: function( result ){
                        if ( $.isFunction( callBack ) ) {
                            // Execute callback function
                            callBack( result );
                        }
                    }
                }
            });
        }
    }
}

