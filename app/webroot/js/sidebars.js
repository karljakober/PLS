$( "body" ).toggleClass( "cbp-spmenu-push" );
$(".nano").nanoScroller({ scroll: 'bottom' });

$( "#showLeftPush" ).click( function() {
    $( "body" ).toggleClass( 'cbp-spmenu-push-toright' );
    $( "#cbp-spmenu-s1" ).toggleClass( 'cbp-spmenu-open' );
});

$( "#showRightPush" ).click( function() {
    $( "body" ).toggleClass( 'cbp-spmenu-push-toleft' );
    $( "#cbp-spmenu-s2" ).toggleClass( 'cbp-spmenu-open' );
});