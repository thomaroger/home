$( window ).on( "load", function() {
   $.get( "/trash", function( data ) {
      $( "#trash" ).html( data );
    });
    $.get( "/weather", function( data ) {
      $( "#weather" ).html( data );
    });
    $.get( "/flipr", function( data ) {
      $( "#flipr" ).html( data );
    });
    $.get( "/netatmo", function( data ) {
      $( "#netatmo" ).html( data );
    });
    $.get( "/volet", function( data ) {
      $( "#volet" ).html( data );
    });
    $.get( "/light", function( data ) {
      $( "#light" ).html( data );
    });
    $.get( "/radiator", function( data ) {
      $( "#radiator" ).html( data );
    });
    $.get( "/gmap", function( data ) {
      $( "#gmap" ).html( data );
    });
});