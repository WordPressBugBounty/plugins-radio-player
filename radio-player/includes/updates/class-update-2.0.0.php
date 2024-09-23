<?php

defined( 'ABSPATH' ) || exit();

class Radio_Player_Update_2_0_0 {

	private static $instance = null;

	public function __construct() {
		$this->create_tables();

		$this->migrate_players();

		$this->migrate_settings();
	}

	public function create_tables() {
		global $wpdb;
		$wpdb->hide_errors();
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$tables = [

			//Players Table
			"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}radio_player_players(
         	id bigint(20) NOT NULL AUTO_INCREMENT,
			status tinyint(1) NOT NULL DEFAULT 1, 
			config longtext NULL,
			title varchar(255) NULL,
			created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
			updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			PRIMARY KEY  (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;",

			//statistics table
			"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}radio_player_statistics(
         	id bigint(20) NOT NULL AUTO_INCREMENT,
			player_id bigint(20) NOT NULL,
         	unique_id varchar (32) NOT NULL DEFAULT '',
			`count` bigint(20) NOT NULL DEFAULT '1',
			user_ip varchar(128)  NOT NULL DEFAULT '',
			created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
			updated_at DATETIME NOT NULL,
			PRIMARY KEY  (id),
			UNIQUE KEY `unique_id` (`unique_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;",

		];

		foreach ( $tables as $table ) {
			dbDelta( $table );
		}
	}

	public function migrate_players() {
		$players = get_posts( [
			'post_type'   => 'radio',
			'numberposts' => - 1,
			'post_status' => 'publish'
		] );

		if ( ! empty( $players ) ) {
			global $wpdb;

			foreach ( $players as $player ) {
				$id         = $player->ID;
				$title      = $player->post_title;
				$created_at = $player->post_date;
				$updated_at = $player->post_modified;
				$status     = $player->post_status == 'publish' ? 1 : 0;

				$config = [
					'id'    => $id,
					'title' => $title,
				];

				$config['status']         = $status;
				$config['skin']           = radio_player_get_meta( $id, 'skin', 'skin1' );
				$config['popup_icon']     = radio_player_get_meta( $id, 'popup_icon', 'off' );
				$config['player_status']  = radio_player_get_meta( $id, 'player_status', 'off' );
				$config['playlist_icon']  = radio_player_get_meta( $id, 'playlist_icon', 'off' );
				$config['volume_control'] = radio_player_get_meta( $id, 'volume_control', 'on' );
				$config['width']          = radio_player_get_meta( $id, 'width', '300' );
				$config['border_radius']  = radio_player_get_meta( $id, 'border_radius', '5' );
				$config['bg_type']        = radio_player_get_meta( $id, 'bg_type' );
				$config['bg_image']       = radio_player_get_meta( $id, 'bg_image' );
				$config['text_color']     = radio_player_get_meta( $id, 'text_color' );
				$config['player_text']    = radio_player_get_meta( $id, 'player_text' );

				$stations = radio_player_get_meta( $id, 'stations' );

				if ( ! empty( $stations ) ) {
					$stations = array_map( function ( $station ) {
						return (array) $station;
					}, $stations );

					$config['stations'] = $stations;
				}


				$bg_color          = radio_player_get_meta( $id, 'bg_color' );
				$bg_color_gradient = radio_player_get_meta( $id, 'bg_color_gradient' );
				$color_type        = radio_player_get_meta( $id, 'color_type' );

				$config['color_type'] = $color_type;

				if ( $color_type == 'gradient' ) {
					$config['bg_color'] = $bg_color_gradient;
				} else {
					$config['bg_color'] = $bg_color;
				}

				if ( ! in_array( $config['skin'], [ 'skin1', 'skin2' ] ) ) {
					switch ( $config['skin'] ) {
						case 'skin3':
							$config['skin'] = 'skin4';
							break;
						case 'skin4':
							$config['skin'] = 'skin5';
							break;
						case 'skin5':
							$config['skin'] = 'skin6';
							break;
						case 'skin6':
							$config['skin'] = 'skin7';
							break;
						case 'skin7':
							$config['skin'] = 'skin8';
							break;
						case 'skin8':
							$config['skin'] = 'skin9';
							break;
						case 'skin9':
							$config['skin'] = 'skin11';
							break;
					}
				}


				// convert on off to 1 0
				$config['popup_icon']     = $config['popup_icon'] == 'on' ? 1 : 0;
				$config['playlist_icon']  = $config['playlist_icon'] == 'on' ? 1 : 0;
				$config['volume_control'] = $config['volume_control'] == 'on' ? 1 : 0;
				$config['player_status']  = $config['player_status'] == 'on' ? 1 : 0;

				$config = serialize( $config );

				$table = $wpdb->prefix . 'radio_player_players';

				$wpdb->insert( $table, [
					'id'         => $id,
					'status'     => $status,
					'config'     => $config,
					'title'      => $title,
					'created_at' => $created_at,
					'updated_at' => $updated_at,
				] );


			}
		}

	}

	public function migrate_settings() {
		$settings = get_option( 'radio_player_settings', [] );

		$sticky_player = get_option( 'radio_player_sticky' );

		if ( ! empty( $sticky_player ) ) {
			$settings['stickyPlayer'] = $sticky_player;
		}

		$displayAll = radio_player_get_setting( 'displayAll', 'on' );

		if ( 'on' != $displayAll ) {
			$stickyPlayerPages = radio_player_get_setting( 'stickyPlayerPages', [] );
			$pages             = wp_list_pluck( $stickyPlayerPages, 'value' );

			$settings['excludeAll']         = 1;
			$settings['excludeExceptPages'] = $pages;
		}

		$httpPlayer             = radio_player_get_setting( 'httpPlayer', 'off' );
		$settings['httpPlayer'] = $httpPlayer == 'on' ? 1 : 0;

		$customPopupSize             = radio_player_get_setting( 'customPopupSize', 'off' );
		$settings['customPopupSize'] = $customPopupSize == 'on' ? 1 : 0;

		$enableStats             = radio_player_get_setting( 'enableStats', 'off' );
		$settings['enableStats'] = $enableStats == 'on' ? 1 : 0;

		$openPlaylist             = radio_player_get_setting( 'openPlaylist', 'off' );
		$settings['openPlaylist'] = $openPlaylist == 'on' ? 1 : 0;

		update_option( 'radio_player_settings', $settings );
	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}


}

Radio_Player_Update_2_0_0::instance();