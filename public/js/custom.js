ClassicEditor
    .create( document.querySelector( '#description' ) )
    .catch( error => {
        console.error( error );
    } );

ClassicEditor
    .create( document.querySelector( '#summary' ) )
    .catch( error => {
        console.error( error );
    } );

$(document).ready(function() {
    $('#category').select2();
})
