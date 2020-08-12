jQuery( document ).ready( function( $ ) {
  $( "#eagatc-revert" ).click( function() {
    $.ajax({
         type: "POST",
         data:{ action:"call_this" },
    } );
    window.location.reload();
  } );
} );
