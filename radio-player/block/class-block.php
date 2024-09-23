<?php

defined( 'ABSPATH' ) || exit();

class Radio_Player_Block {
	/**
	 * @var null
	 */
	protected static $instance = null;

	public function __construct() {
		add_action( 'init', [ $this, 'register_block' ] );
	}

	public function register_block() {
		register_block_type( RADIO_PLAYER_PATH . '/block/build/radio-player', [
			'render_callback' => [ $this, 'radio_player_render_block' ],
		] );
	}

	public function radio_player_render_block( $attributes ) {

		$id        = ! empty( $attributes['id'] ) ? $attributes['id'] : '';
		$alignment = ! empty( $attributes['align'] ) ? $attributes['align'] : 'center';

		return sprintf( '<div class="align%s">%s</div>', esc_attr($alignment), do_shortcode( "[radio_player id=$id]" ) );
	}

	/**
	 * @return Radio_Player_Block|null
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}

Radio_Player_Block::instance();


