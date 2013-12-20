<?php
/**
 * Plugin Name: 01_HookUp Tutorial - Part One.
 * Description: Remove hooks with _wp_filter_build_unique_id() added by a class
 */

class PrintAdminNotice
{
	public $pattern = '<div class="%s">%s</div>';

	public $msg = '';

	public $css_class = 'error';

	public function __construct( $msg='' ) {

		if ( ! empty( $msg ) ) {

			$this->msg = $msg;
			$this->add_hook();

		}

	}

	public function add_hook() {

		add_action(
			'admin_notices',
			array( $this, 'print_notice' ),
			10,
			0
		);

	}

	public function print_notice() {

		printf( $this->pattern, $this->css_class, $this->msg );

	}

}

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