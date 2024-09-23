<?php

defined( 'ABSPATH' ) || exit();

class Radio_Player_Locations {

	private static $instance = null;

	public function __construct() {
		// Monitoring hooks.
		add_action( 'save_post', [ $this, 'save_post' ], 10, 3 );
		add_action( 'post_updated', [ $this, 'post_updated' ], 10, 3 );
		add_action( 'wp_trash_post', [ $this, 'trash_post' ] );
		add_action( 'untrash_post', [ $this, 'untrash_post' ] );
		add_action( 'delete_post', [ $this, 'trash_post' ] );
	}

	public function save_post( $post_ID, $post, $update ) {

		if (
			$update
			|| ! in_array( $post->post_type, $this->get_post_types(), true )
			|| ! in_array( $post->post_status, $this->get_post_statuses(), true )
		) {
			return;
		}

		error_log( 'save_post_a');

		$player_ids = $this->get_player_ids( $post->post_content );

		$this->update_shortcode_locations( $post, [], $player_ids );
	}

	public function post_updated( $post_id, $post_after, $post_before ) {

		if (
			! in_array( $post_after->post_type, $this->get_post_types(), true ) ||
			! in_array( $post_after->post_status, $this->get_post_statuses(), true )
		) {
			return;
		}

		$player_ids_before = $this->get_player_ids( $post_before->post_content );
		$player_ids_after  = $this->get_player_ids( $post_after->post_content );

		$this->update_shortcode_locations( $post_after, $player_ids_before, $player_ids_after );
	}

	public function trash_post( $post_id ) {

		$post              = get_post( $post_id );
		$player_ids_before = $this->get_player_ids( $post->post_content );
		$player_ids_after  = [];

		$this->update_shortcode_locations( $post, $player_ids_before, $player_ids_after );
	}

	public function untrash_post( $post_id ) {

		$post              = get_post( $post_id );
		$player_ids_before = [];
		$player_ids_after  = $this->get_player_ids( $post->post_content );

		$this->update_shortcode_locations( $post, $player_ids_before, $player_ids_after );
	}

	public function update_shortcode_locations( $post_after, $player_ids_before, $player_ids_after ) {

		global $wpdb;

		$table = $wpdb->prefix . 'radio_player_players';

		$post_id = $post_after->ID;
		$url     = get_permalink( $post_id );
		$url     = ( $url === false || is_wp_error( $url ) ) ? '' : $url;

		$player_ids_to_remove = array_diff( $player_ids_before, $player_ids_after );
		$player_ids_to_add    = array_diff( $player_ids_after, $player_ids_before );

		foreach ( $player_ids_to_remove as $player_id ) {
			$locations = $this->get_locations_without_current_post( $player_id, $post_id );

			$wpdb->update( $table, [ 'locations' => maybe_serialize( $locations ), ], [ 'id' => $player_id ] );

		}

		foreach ( $player_ids_to_add as $player_id ) {
			$locations = $this->get_locations_without_current_post( $player_id, $post_id );

			$locations[] = [
				'type'      => $post_after->post_type,
				'title'     => $post_after->post_title,
				'player_id' => $player_id,
				'post_id'   => $post_id,
				'status'    => $post_after->post_status,
				'url'       => $url,
			];

			$wpdb->update( $table, [ 'locations' => maybe_serialize( $locations ), ], [ 'id' => $player_id ] );

		}
	}

	/**
	 * Get post types for search in.
	 *
	 * @return string[]
	 * @since 1.7.4
	 *
	 */
	public function get_post_types() {

		$args       = [
			'public'             => true,
			'publicly_queryable' => true,
		];
		$post_types = get_post_types( $args, 'names', 'or' );

		unset( $post_types['attachment'] );

		$post_types[] = 'wp_template';
		$post_types[] = 'wp_template_part';

		return $post_types;
	}

	/**
	 * Get post statuses for search in.
	 *
	 * @return string[]
	 * @since 1.7.4
	 *
	 */
	public function get_post_statuses() {

		return [ 'publish', 'pending', 'draft', 'future', 'private' ];
	}

	public function get_player_ids( $content ) {

		$player_ids = [];

		if (
			preg_match_all(
			/**
			 * Extract id from shortcode or block.
			 * Examples:
			 * [integrate_google_drive id="32" ]
			 * <!-- wp:igd/shortcodes {"id":"32"} /-->
			 * In both, we should find 32.
			 */
				'#\[\s*radio_player.+id\s*=\s*"(\d+?)".*]|<!-- wp:igd/shortcodes {"id":"(\d+).*?"} /-->#',
				$content,
				$matches
			)
		) {
			array_shift( $matches );
			$player_ids = array_map(
				'intval',
				array_unique( array_filter( array_merge( ...$matches ) ) )
			);
		}

		return $player_ids;
	}

	private function get_locations_without_current_post( $player_id, $post_id ) {

		global $wpdb;
		$table = $wpdb->prefix . 'radio_player_players';

		$locations = $wpdb->get_var( $wpdb->prepare( "SELECT locations FROM $table WHERE id = %d", $player_id ) );
		$locations = ! empty( $locations ) ? array_values( maybe_unserialize( $locations ) ) : [];

		if ( ! is_array( $locations ) ) {
			$locations = [];
		}

		return array_filter(
			$locations,
			static function ( $location ) use ( $post_id ) {

				return $location['post_id'] !== $post_id;
			}
		);
	}

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

}

Radio_Player_Locations::instance();