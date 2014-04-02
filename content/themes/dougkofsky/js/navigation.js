/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens, and keyboard navigation between prints.
 */
( function() {
	var container, button, menu;

	container = document.getElementById( 'site-navigation' );
	if ( ! container )
		return;

	button = container.getElementsByTagName( 'div' )[0];
	if ( 'undefined' === typeof button )
		return;

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( -1 === menu.className.indexOf( 'nav-menu' ) )
		menu.className += ' nav-menu';

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) )
			container.className = container.className.replace( ' toggled', '' );
		else
			container.className += ' toggled';
	};
} )();

// Keyboard Navigation
(function($){
   $(document).ready(function () {
      $(document).keydown(function(e) {
         var url = false;
         if (e.which == 37) {  // Left arrow key code
            url = $('.page-previous a').attr('href');    }
         else if (e.which == 39) {  // Right arrow key code
            url = $('.page-next a').attr('href');    }
         if (url) { window.location = url;   }
     });
   });
})(jQuery);
