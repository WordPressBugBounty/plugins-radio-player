<?php

defined( 'ABSPATH' ) || exit;

/**
 * Class Install
 */
class Radio_Player_Install {

	/**
	 * Plugin activation stuffs
	 *
	 * @since 1.0.0
	 */
	public static function activate() {
		if ( ! class_exists( 'Radio_Player_Update' ) ) {
			require_once RADIO_PLAYER_INCLUDES . '/class-update.php';
		}

		$updater = new Radio_Player_Update();

		if ( $updater->needs_update() ) {
			$updater->perform_updates();
		} else {
			self::create_tables();
			self::create_default_data();
		}
	}

	public static function deactivate() {
		self::remove_cron_event();
	}

	public static function remove_cron_event() {
		$hooks = [
			'radio_player_statistics_daily_report',
			'radio_player_statistics_weekly_report',
			'radio_player_statistics_monthly_report',
		];

		foreach ( $hooks as $hook ) {
			$timestamp = wp_next_scheduled( $hook );
			if ( $timestamp ) {
				wp_unschedule_event( $timestamp, $hook );
			}
		}
	}

	private static function create_tables() {
		global $wpdb;
		$wpdb->hide_errors();
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$tables = [

			// Players Table
			"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}radio_player_players(
         	id bigint(20) NOT NULL AUTO_INCREMENT,
			status tinyint(1) NOT NULL DEFAULT 1, 
			config longtext NULL,
			title varchar(255) NULL,
			locations longtext NULL,
			created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
			updated_at DATETIME NOT NULL,
			PRIMARY KEY  (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

			// Statistics table
			"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}radio_player_statistics(
         	id bigint(20) NOT NULL AUTO_INCREMENT,
			player_id bigint(20) NOT NULL,
         	unique_id varchar (32) NOT NULL DEFAULT '',
			`count` bigint(20) NOT NULL DEFAULT '1',
			user_ip varchar(128)  NOT NULL DEFAULT '',
			created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
			updated_at DATETIME NOT NULL,
			PRIMARY KEY  (id),
			UNIQUE KEY `unique_id` (`unique_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

		];

		foreach ( $tables as $table ) {
			dbDelta( $table );
		}
	}

	/**
	 * Create plugin settings default data
	 *
	 * @since 1.0.0
	 */
	private static function create_default_data() {

		$version      = get_option( 'radio_player_version', '0' );
		$install_time = get_option( 'radio_player_install_time', '' );

		if ( empty( $version ) ) {
			update_option( 'radio_player_version', RADIO_PLAYER_VERSION );
		}

		if ( empty( $install_time ) ) {
			$date_format = get_option( 'date_format' );
			$time_format = get_option( 'time_format' );

			update_option( 'radio_player_install_time', date( $date_format . ' ' . $time_format ) );
		}

		set_transient( 'radio_player_rating_notice_interval', 'off', 10 * DAY_IN_SECONDS );


	}


}