<?php
/**
 * Plugin Name: 01_HookUp Tutorial - Part One
 * Description: Adding and removing hooks in a prozedual programming
 */

add_action(
	'plugins_loaded',
	'add_widget_hook'
);

function add_widget_hook() {

	add_action(
		'wp_dashboard_setup',
		'add_dashboard_widget'
	);

}

function add_dashboard_widget() {

	wp_add_dashboard_widget(
		'Test-widget',
		'Test Widget',
		'hooktest_output',
		$control_callback = null
	);

}


function hooktest_output() {

	add_action( 'test_hook', 'hook_callback', 0, 2 );

	$demo = new Demo_Hook();
	add_action( 'test_hook', array( $demo, 'print_var' ), 0, 1 );

// 	unset( $GLOBALS['wp_filter']['test_hook'] );
	// [...]


	echo '<div class="wrap">';

	var_dump( $GLOBALS['wp_filter']['test_hook'][0] );

	$var = 'The callback';

	do_action( 'test_hook', $var_old );

	echo '</div>';

}

function hook_callback( $hook_var ) {

	printf( 'With do_action(): %s was called by <code>do_action()</code><br>', $hook_var );

	return true;

}

class Demo_Hook
{
	public function print_var( $var ) {
		printf( '<p>%s</p>', $var );
	}
}

