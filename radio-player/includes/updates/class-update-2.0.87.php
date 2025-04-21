<?php

defined( 'ABSPATH' ) || exit();

class Radio_Player_Update_2_0_87 {

	private static $instance = null;

	public function __construct() {
		$this->update_local_station_source_type();

		$this->recreate_statistics_table();
	}

	public function update_local_station_source_type() {
		$players = radio_player_get_players();

		if ( empty( $players ) ) {
			return;
		}

		foreach ( $players as $player ) {
			$stations = isset( $player['config']['stations'] ) ? $player['config']['stations'] : [];

			if ( empty( $stations ) ) {
				continue;
			}

			foreach ( $stations as $index => $station ) {
				$stream_url = isset( $station['stream'] ) ? $station['stream'] : '';

				$stations[ $index ]['source_type'] = strpos( $stream_url, home_url() ) !== false ? 'local' : 'stream';
			}

			$player['config']['stations'] = $stations;
			$serialized_config            = maybe_serialize( $player['config'] );

			global $wpdb;

			$wpdb->update(
				$wpdb->prefix . 'radio_player_players',
				[ 'config' => $serialized_config ],
				[ 'id' => $player['id'] ]
			);
		}
	}

	public function recreate_statistics_table() {

		global $wpdb;
		$wpdb->hide_errors();

		$table_name = "{$wpdb->prefix}radio_player_statistics";

		$wpdb->query( "DROP TABLE IF EXISTS {$table_name}" );

		$charset_collate = $wpdb->get_charset_collate();

		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE {$table_name} (
		        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
		        player_id VARCHAR(100) NOT NULL,
		        station INT NOT NULL,
		        action VARCHAR(50) NOT NULL,
		        browser VARCHAR(100) DEFAULT '',
		        os VARCHAR(100) DEFAULT '',
		        device VARCHAR(100) DEFAULT '',
		        user_id INT NULL,
		        ip VARCHAR(100) DEFAULT '',
		        country VARCHAR(100) DEFAULT '',
		        page TEXT,
		        duration INT DEFAULT 0,
		        timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
		        PRIMARY KEY (id),
		        INDEX station_idx (station),
		        INDEX action_idx (action),
		        INDEX timestamp_idx (timestamp)
    ) $charset_collate;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );
	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}


}

Radio_Player_Update_2_0_87::instance();