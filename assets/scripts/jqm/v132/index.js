
$( document ).on( "pageinit", ".jqm-demos", function() {
	

	$( document ).on( "swipeleft swiperight", "#demo-page", function( e ) {
        // We check if there is no open panel on the page because otherwise
        // a swipe to close the left panel would also open the right panel (and v.v.).
        // We do this by checking the data that the framework stores on the page element (panel: open).
        if ( $.mobile.activePage.jqmData( "panel" ) !== "open" ) {
            if ( e.type === "swipeleft"  ) {
                $( "#right-panel" ).panel( "open" );
            } else if ( e.type === "swiperight" ) {
                $( "#left-panel" ).panel( "open" );
            }
        }
    });
	
	$( this ).find( ".jqm-header .jqm-search-link" ).on( "click", function() {
		$( this ).parent( ".jqm-header" ).toggleClass( "jqm-search-toggle" );
		
		var type = $( this ).parent( ".jqm-header" ).hasClass( "jqm-search-toggle" ) ? "searchshow" : "searchhide";
		
		$( this ).parent( ".jqm-header" ).find( ".jqm-search" ).trigger( type );
	});
	
	$( this ).find( ".jqm-header .jqm-search" )
		.on( "searchshow searchhide", function( event ) {
			if ( event.type === "searchshow" ) {
				$( this ).find( ".ui-input-text" ).focus();
			} else {
				$( this )
					.find( ".ui-input-clear" ).trigger( "click" )
					.end()
					.find( ".ui-input-text" ).blur();
			}
		});
		
	$( this ).on( "pagehide", function() {
		$( this ).find( ".jqm-search .ui-input-clear" ).trigger( "click" );
	});

});
