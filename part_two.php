<?php
/**
 * Plugin Name: 02_HookUp Tutorial - Part Two
 * Description: Remove hooks with _wp_filter_build_unique_id() added by a class
 */

require_once 'class-printadminnotice.php';

function start_plugin_hookup() {

	global $pagenow;

	$msg_red  = new PrintAdminNotice( 'Woohoo! The plugin works!' );

	if ( 'index.php' == $pagenow ) {

		$msg_green = new PrintAdminNotice( 'On the dashboard another message will be displayed.' );
		$msg_green->css_class = 'updated';

		remove_action(
			'admin_notices',
			_wp_filter_build_unique_id(
				'admin_notices',
				array( $msg_red, 'print_notice' ),
				false
			)
		);

	}
}


add_action(
	'plugins_loaded',
	'start_plugin_hookup'
);