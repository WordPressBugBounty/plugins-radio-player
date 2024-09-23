<?php

defined( 'ABSPATH' ) || exit();

class Radio_Player_Elementor {

	private static $instance = null;

	public function __construct() {
		add_action( 'elementor/frontend/before_enqueue_scripts', [ new Radio_Player_Enqueue(), 'frontend_scripts' ] );

		//register elementor widget
		add_action( 'elementor/widgets/register', [ $this, 'register_widget' ] );
	}

	/**
	 * Register elementor player widget
	 *
	 * @return void
	 * @since 1.0.0
	 *
	 */
	public function register_widget( $widgets_manager ) {

		require RADIO_PLAYER_PATH . '/elementor/class-elementor-player-widget.php';

		$widgets_manager->register( new Radio_Player_Elementor_Widget() );
	}

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

}

Radio_Player_Elementor::instance();