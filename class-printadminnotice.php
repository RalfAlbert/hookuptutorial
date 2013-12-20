<?php
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
