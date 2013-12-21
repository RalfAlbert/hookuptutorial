<?php
/**
 * Plugin Name: 04_HookUp Tutorial - Part Four.
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
	add_filter( 'test_hook', 'hook_callback', 0, 2 );

	// [...]


	echo '<div class="wrap">';
	var_dump( $GLOBALS['wp_filter']['test_hook'] );

	$var_old = 'The callback';

	do_action( 'test_hook', $var_old, 'do_action' );

	$var_new = apply_filters( 'test_hook', $var_old );

	printf( '<p>With apply_filters(): %s</p>', $var_new );


	echo '</div>';

}

function hook_callback( $hook_var, $action_or_filter = 'do_filter' ) {

	if ( 'do_action' === $action_or_filter ) {

		printf( 'With do_action(): %s was called by <code>do_action()</code><br>', $hook_var );

		return true;

	}

	$hook_var = (string) $hook_var;
	$hook_var .= ' was called by <code>apply_filters()</code>';

	return $hook_var;

}

