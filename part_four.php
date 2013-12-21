<?php
/**
 * Plugin Name: 04_HookUp Tutorial - Part Four
 * Description: The unremoveable hooks.  <strong>This part requires at minimum PHP5.3!</strong>
 */

require_once 'class-printadminnotice.php';

function start_plugin_hookup() {

	global $pagenow;

	// create an object in another function, but do not make the object global
	non_global_object();

	// direct class call
	new PrintAdminNotice( 'The anonymous class instance...' );

	// use an anonymous function stored in a variable, but didn't make the variable global
	non_global_anonymous_function();

	// use an anonymous function (closure) within the add_action() call
	add_action(
		'admin_notices',
		function() { echo '<div class="error">There is no way to remove me!!</div>'; },
		10,
		0
	);

	if ( 'index.php' === $pagenow ) {

		// the anonymous function is not stored in a variable, we cannot remove it

		// $msg_non_global is not in the scope of this function, we cannot remove the action
		// same with $removemenot

		// even if we create an new object from the class, we can't remove the hook
		// because the hash of $remove_object is different from $msg_non_global
		$remove_object = new PrintAdminNotice();

		remove_action(
			'admin_notices',
			_wp_filter_build_unique_id(
				'admin_notices',
				$removeme_object,
				false
			)
		);

	}
}

function non_global_object() {
	$msg_non_global = new PrintAdminNotice( 'This message is created with a non global object and can\'t be removed.' );
}

function non_global_anonymous_function() {
	$removenot = function() { echo '<div class="error">I\'m an anonymous function stored in a var, but I\'m not global so you can\'t remove me.</div>'; };
	add_action(
		'admin_notices',
		$removenot,
		10,
		0
	);
}

add_action(
	'plugins_loaded',
	'start_plugin_hookup'
);