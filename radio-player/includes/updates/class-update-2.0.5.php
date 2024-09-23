<?php

defined( 'ABSPATH' ) || exit();

class Radio_Player_Update_2_0_5 {

	private static $instance = null;

	public function __construct() {
		$this->deactivate_radio_player_ads_plugin();
	}


	public function deactivate_radio_player_ads_plugin() {
		$plugin = 'radio-player-ads-premium/plugin.php'; // Replace with your plugin path

		if ( is_plugin_active( $plugin ) ) {

			//get plugin version
			$plugin_data    = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
			$plugin_version = $plugin_data['Version'];

			if ( '1.0.0' == $plugin_version ) {
				update_option( 'radio_player_ads_notice', true );
				deactivate_plugins( $plugin );
			}
		}
	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}


}

Radio_Player_Update_2_0_5::instance();