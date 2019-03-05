/**
 * File navigation.js.
 *
 */

( function( $ ) {
    var pull   = $('#pull'),
        toggle = $( '#toggle' ),
        menu   = $('.menu-menu-1-container');
 
    pull.on('click', function( e ) {
        e.preventDefault();
        menu.slideToggle();
        toggle.toggleClass( 'on' );
    });

    $( window ).resize( function() {
        var w = $( window ).width();
        if( w > 991 && menu.is( ':hidden' ) ) {
            menu.removeAttr('style');
        }
    });
})( jQuery );


