
(function($) {

	/**--------------------------------------------------------------
	# Responsive Navigation for WordPress menus
	--------------------------------------------------------------*/
	$.fn.responsiveMenu = function( options ) {

		if ( options === undefined ) {
			options = {};
		}

		/* Set Defaults */
		var defaults = {
			menuClass: 'menu',
			toggleClass: 'menu-toggle',
			toggleText: '',
			maxWidth: '60em'
		};

		/* Set Variables */
		var vars = $.extend( {}, defaults, options ),
			menuClass = vars.menuClass,
			toggleID = ( vars.toggleID ) ? vars.toggleID : vars.toggleClass,
			toggleClass = vars.toggleClass,
			toggleText = vars.toggleText,
			maxWidth = vars.maxWidth,
			$this = $( this ),
			$menu = $( '.' + menuClass );

		/*********************
		* Desktop Navigation *
		**********************/

		/* Set and reset dropdown animations based on screen size */
		if ( typeof matchMedia == 'function' ) {
			var mq = window.matchMedia( '(max-width: ' + maxWidth + ')' );
			mq.addListener( widthChange );
			widthChange( mq );
		}
		function widthChange( mq ) {

			if ( mq.matches ) {

				/* Reset desktop navigation menu dropdown animation on smaller screens */
				$menu.find( 'ul.sub-menu' ).css( { display: 'block' } );
				$menu.find( 'li ul.sub-menu' ).css( { visibility: 'visible', display: 'block' } );
				$menu.find( 'li.menu-item-has-children' ).unbind( 'mouseenter mouseleave' );

				$menu.find( 'li.menu-item-has-children ul.sub-menu' ).each( function() {
					$( this ).hide();
					$( this ).parent().find( '.submenu-dropdown-toggle' ).removeClass( 'active' );
				} );

				/* Remove ARIA states on mobile devices */
				$menu.find( 'li.menu-item-has-children > a' ).unbind( 'focus.aria mouseenter.aria blur.aria  mouseleave.aria' );

			} else {

				/* Add dropdown animation for desktop navigation menu */
				$menu.find( 'ul.sub-menu' ).css( { display: 'none' } );
				$menu.find( 'li.menu-item-has-children' ).mouseenter( function() {
					$( this ).find( 'ul:first' ).css( { visibility: 'visible', display: 'none' } ).slideDown( 300 );
					// if ( $( this ).children( 'ul.sub-menu' ).offset().left + 250 > $( window ).width() ) {
					// 	$( this ).children( 'ul.sub-menu' ).addClass('right');
					// }else if ( $( this ).children( 'ul.sub-menu' ).offset().left + 250 < $( window ).width() ) {
					// 	$( this ).children( 'ul.sub-menu' ).removeClass('right');
					// }
				});
				$menu.children( 'li.menu-item-has-children' ).mouseenter(function () {
					if ( $( this ).children( 'ul.sub-menu' ).offset().left + 250 > $( window ).width() ) {
						$( this ).children( 'ul.sub-menu' ).addClass('right');
					}
				});
				$menu.children( 'li.menu-item-has-children' ).mouseleave(function () {
					$( this ).children( 'ul.sub-menu' ).removeClass('right');
				});
				$menu.find( 'li.menu-item-has-children' ).mouseleave(function() {
					$( this ).find( 'ul:first' ).css( { visibility: 'hidden', display: 'none' } );
				} );

				/* Make sure menu does not fly off the right of the screen */
				$menu.find( 'li ul.sub-menu li.menu-item-has-children' ).mouseenter( function() {
					if ( $( this ).children( 'ul.sub-menu' ).offset().left + 250 > $( window ).width() ) {
						$( this ).children( 'ul.sub-menu' ).css( { right: '100%', left: 'auto' } );
							$( this ).children( 'ul.sub-menu' ).addClass('right');

					}
				} );

				// Add menu items with submenus to aria-haspopup="true".
				$menu.find( 'li.menu-item-has-children' ).attr( 'aria-haspopup', 'true' ).attr( 'aria-expanded', 'false' );

			}

		}

		/********************
		* Mobile Navigation *
		*********************/

		/* Add Menu Toggle Button for mobile navigation */
		$this.before( '<button id=\"' + toggleID + '\" class=\"' + toggleClass + '\">' + toggleText + '</button>' );

		/* Add dropdown toggle for submenus on mobile navigation */
		$menu.find( 'li.menu-item-has-children' ).prepend( '<span class=\"submenu-dropdown-toggle\"></span>' );

		/* Add dropdown slide animation for mobile devices */
		$( '#' + toggleID ).on( 'click', function() {
			$menu.slideToggle();
			$( this ).toggleClass( 'active' );
		});

		/* Add dropdown animation for submenus on mobile navigation */
		$menu.find( 'li.menu-item-has-children .sub-menu' ).each( function () {
			$( this ).hide();
		} );
		$menu.find( '.submenu-dropdown-toggle' ).on( 'click', function() {
			$( this ).parent().find( 'ul:first' ).slideToggle();
			$( this ).toggleClass( 'active' );
		});

	};

	/**--------------------------------------------------------------
	# Setup Navigation Menus
	--------------------------------------------------------------*/
	$( document ).ready( function() {

		/* Setup Main Navigation */
		$( '.headerWrapper .container' ).responsiveMenu( {
			menuClass: 'wp-menu',
			maxWidth: '950px'
		} );

	} );

}(jQuery));
