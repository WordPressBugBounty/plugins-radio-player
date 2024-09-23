<?php

defined( 'ABSPATH' ) || exit();

class Radio_Player_Update_2_0_4 {

	private static $instance = null;

	public function __construct() {
		$this->add_table_col();
		$this->update_shortcode_locations();
	}

	public function add_table_col() {
		global $wpdb;

		$table_name = $wpdb->prefix . 'radio_player_players';

		$sql = "ALTER TABLE $table_name ADD `locations` LONGTEXT NULL AFTER `title`;";
		$wpdb->query( $sql );
	}

	public function update_shortcode_locations() {
		$pages = get_pages( [
			'number' => 999,
		] );

		$locator = new Radio_Player_Locations();

		foreach ( $pages as $page ) {
			$shortcode_ids = $locator->get_player_ids( $page->post_content );
			$locator->update_shortcode_locations( $page, [], $shortcode_ids );
		}

	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}


}

Radio_Player_Update_2_0_4::instance();