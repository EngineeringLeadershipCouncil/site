


<?php
function toggle_wp_nav_menu_args( $args = '' ) {
	if( is_user_logged_in() ) {
		$args['menu'] = 'logged-in';
		echo "logged-in";
		}
	else {
		$args['menu'] = 'logged-out';
		echo "logged-out";
		}
		return $args;
	}
add_filter( 'wp_nav_menu_args', 'toggle_wp_nav_menu_args' );
?>
