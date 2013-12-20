<?php
/**
 * Plugin Name: 02_HookUp Tutorial - Part Two.
 * Description: Hooks added by an anonymous function. <strong>This part requires at minimum PHP5.3!</strong>
 */

function start_plugin_hookup() {

	global $pagenow;

	// anonymous function in a variable
	$removeme = function() { echo '<div class="error">It\'s easy to remove me!!</div>'; };

	add_action(
		'admin_notices',
		$removeme,
		10,
		0
	);

	if ( 'index.php' == $pagenow ) {

		remove_action(
			'admin_notices',
			_wp_filter_build_unique_id(
				'admin_notices',
				$removeme,
				false
			)
		);

	}

}

add_action(
	'plugins_loaded',
	'start_plugin_hookup'
);