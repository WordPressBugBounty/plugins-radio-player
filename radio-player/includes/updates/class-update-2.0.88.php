<?php

defined( 'ABSPATH' ) || exit();

class Radio_Player_Update_2_0_88 {

	private static $instance = null;

	public function __construct() {
		$this->flush_rewrite_rules();
	}

	public function flush_rewrite_rules() {
		add_rewrite_rule( '^radio-player/([0-9]+)/?$', 'index.php?radio-player=$matches[1]', 'top' );
		flush_rewrite_rules();
	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}


}

Radio_Player_Update_2_0_88::instance();