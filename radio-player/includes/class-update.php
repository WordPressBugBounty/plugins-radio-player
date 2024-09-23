<?php

defined( 'ABSPATH' ) || exit();

class Radio_Player_Update {

	/**
	 * The upgrades
	 *
	 * @var array
	 */
	private static $upgrades = array( '2.0.0', '2.0.4', '2.0.5' );

	public function installed_version() {
		return get_option( 'radio_player_version' );
	}

	/**
	 * Check if the plugin needs any update
	 *
	 * @return boolean
	 */
	public function needs_update() {

		$players = get_posts( [
			'post_type'   => 'radio',
			'numberposts' => 1,
			'post_status' => 'publish'
		] );

		if ( ! empty( $players ) && empty( $this->installed_version() ) ) {
			return true;
		}

		// may be it's the first install
		if ( empty( $this->installed_version() ) ) {
			return false;
		}

		//if previous version is lower
		if ( version_compare( $this->installed_version(), RADIO_PLAYER_VERSION, '<' ) ) {
			return true;
		}


		return false;
	}

	/**
	 * Perform all the necessary upgrade routines
	 *
	 * @return void
	 */
	public function perform_updates() {

		foreach ( self::$upgrades as $version ) {

			if ( version_compare( $this->installed_version(), $version, '<' ) ) {
				$file = RADIO_PLAYER_INCLUDES . "/updates/class-update-$version.php";

				if ( file_exists( $file ) ) {
					include_once $file;
				}

				update_option( 'radio_player_version', $version );
			}
		}

		delete_option( 'radio_player_version' );
		update_option( 'radio_player_version', RADIO_PLAYER_VERSION );
	}


}