<?php

defined( 'ABSPATH' ) || exit;
class Radio_Player_Ajax {
    private static $instance = null;

    public function __construct() {
        // Get Players
        add_action( 'wp_ajax_rp_get_players', [$this, 'get_players'] );
        // Update Player
        add_action( 'wp_ajax_rp_update_player', [$this, 'update_player'] );
        // Delete Player
        add_action( 'wp_ajax_rp_delete_player', [$this, 'delete_player'] );
        // Update Settings
        add_action( 'wp_ajax_rp_update_settings', [$this, 'update_settings'] );
        // Export Data
        add_action( 'wp_ajax_rp_get_export_data', [$this, 'export_data'] );
        // Import Data
        add_action( 'wp_ajax_rp_import_data', [$this, 'import_data'] );
        // Get Pages
        add_action( 'wp_ajax_rp_get_pages', [$this, 'get_pages'] );
        // Create Page
        add_action( 'wp_ajax_rp_create_page', [$this, 'create_page'] );
        // Handle admin  notice
        add_action( 'wp_ajax_radio_player_hide_review_notice', [$this, 'hide_review_notice'] );
        add_action( 'wp_ajax_radio_player_review_feedback', [$this, 'handle_review_feedback'] );
        // Get streams data
        add_action( 'wp_ajax_radio_player_get_streams_data', [$this, 'get_streams_data'] );
        add_action( 'wp_ajax_nopriv_radio_player_get_streams_data', [$this, 'get_streams_data'] );
        // Get stream History
        add_action( 'wp_ajax_radio_player_get_stream_history', [$this, 'get_stream_history'] );
        add_action( 'wp_ajax_nopriv_radio_player_get_stream_history', [$this, 'get_stream_history'] );
    }

    public function create_page() {
        // Check nonce
        if ( !check_ajax_referer( 'radio-player', 'nonce', false ) ) {
            wp_send_json_error( __( 'Invalid nonce', 'radio-player' ) );
        }
        // Check permission
        if ( !current_user_can( 'edit_pages' ) ) {
            wp_send_json_error( __( 'Permission denied.', 'radio-player' ) );
        }
        $title = sanitize_text_field( $_POST['title'] ?? '' );
        $player_id = sanitize_text_field( $_POST['id'] ?? '' );
        $post_type = 'page';
        // Check if block editor is enabled for this post-type
        if ( function_exists( 'use_block_editor_for_post_type' ) && use_block_editor_for_post_type( $post_type ) ) {
            $content = sprintf( '<!-- wp:radio-player/radio-player {"id":%d} /-->', $player_id );
        } else {
            $content = sprintf( '[radio_player id="%d"]', $player_id );
        }
        $page_id = wp_insert_post( [
            'post_title'   => $title,
            'post_content' => $content,
            'post_status'  => 'draft',
            'post_type'    => $post_type,
        ] );
        if ( is_wp_error( $page_id ) ) {
            wp_send_json_error( $page_id->get_error_message() );
        }
        wp_send_json_success( [
            'id'    => $page_id,
            'title' => $title,
        ] );
    }

    public function get_pages() {
        // Check nonce
        if ( !check_ajax_referer( 'radio-player', 'nonce', false ) ) {
            wp_send_json_error( __( 'Invalid nonce', 'radio-player' ) );
        }
        $pages = get_posts( [
            'post_type'      => 'page',
            'post_status'    => 'publish',
            'posts_per_page' => 100,
            'fields'         => ['ID', 'post_title'],
        ] );
        if ( empty( $pages ) ) {
            wp_send_json_success( [] );
        }
        $formatted = array_map( function ( $page ) {
            return [
                'id'    => $page->ID,
                'title' => esc_html( $page->post_title ),
            ];
        }, $pages );
        wp_send_json_success( $formatted );
    }

    public function get_stream_history() {
        // Check nonce
        if ( !check_ajax_referer( 'radio-player', 'nonce', false ) ) {
            wp_send_json_error( __( 'Invalid nonce', 'radio-player' ) );
        }
        $url = ( !empty( $_REQUEST['url'] ) ? esc_url( $_REQUEST['url'] ) : '' );
        if ( empty( $url ) ) {
            wp_send_json_error( __( 'No URL Provided!', 'radio-player' ) );
        }
        $history = Radio_Player_Stream_Data::instance( $url )->get_history__premium_only();
        wp_send_json_success( $history );
    }

    public function get_streams_data() {
        // Check nonce
        if ( !check_ajax_referer( 'radio-player', 'nonce', false ) ) {
            wp_send_json_error( __( 'Invalid nonce', 'radio-player' ) );
        }
        $streams = ( !empty( $_REQUEST['streams'] ) ? array_filter( array_map( 'sanitize_text_field', $_REQUEST['streams'] ) ) : [] );
        if ( empty( $streams ) ) {
            wp_send_json_error( __( 'No URL provided!', 'radio-player' ) );
        }
        $stream_data = [];
        foreach ( $streams as $stream ) {
            $stream_instance = new Radio_Player_Stream_Data($stream);
            $data = $stream_instance->get_stream_data();
            $stream_data[$stream] = $data;
        }
        wp_send_json_success( $stream_data );
    }

    public function hide_review_notice() {
        // Check nonce
        if ( !check_ajax_referer( 'radio-player', 'nonce', false ) ) {
            wp_send_json_error( __( 'Invalid nonce', 'radio-player' ) );
        }
        update_option( 'radio_player_rating_notice', 'off' );
    }

    public function handle_review_feedback() {
        // Check nonce
        if ( !check_ajax_referer( 'radio-player', 'nonce', false ) ) {
            wp_send_json_error( __( 'Invalid nonce', 'radio-player' ) );
        }
        $feedback = ( !empty( $_POST['feedback'] ) ? sanitize_textarea_field( $_POST['feedback'] ) : '' );
        if ( !empty( $feedback ) ) {
            $feedback = sanitize_textarea_field( $feedback );
            $website_url = get_bloginfo( 'url' );
            /* translators: %s: User feedback */
            $feedback = sprintf( __( 'Feedback: %s', 'radio-player' ), $feedback );
            $feedback .= '<br>';
            /* translators: %s: Website URL */
            $feedback .= sprintf( __( 'Website URL: %s', 'radio-player' ), $website_url );
            /* translators: %s: Plugin name */
            $subject = sprintf( __( 'Feedback for %s', 'radio-player' ), 'Radio Player' );
            $to = 'israilahmed5@gmail.com';
            $headers = ['Content-Type: text/html; charset=UTF-8', 'From: ' . get_bloginfo( 'name' ) . ' <' . get_bloginfo( 'admin_email' ) . '>'];
            wp_mail(
                $to,
                $subject,
                $feedback,
                $headers
            );
            $this->hide_review_notice();
            wp_send_json_success();
        } else {
            wp_send_json_error();
        }
    }

    public function import_data() {
        // Check nonce
        if ( !check_ajax_referer( 'radio-player', 'nonce', false ) ) {
            wp_send_json_error( __( 'Invalid nonce', 'radio-player' ) );
        }
        // Check permission
        if ( !current_user_can( 'manage_options' ) ) {
            wp_send_json_error( __( 'You do not have permission to import data', 'radio-player' ) );
        }
        $settings = ( !empty( $_POST['data']['settings'] ) ? rp_sanitize_array( $_POST['data']['settings'] ) : [] );
        $players = ( !empty( $_POST['data']['players'] ) ? rp_sanitize_array( $_POST['data']['players'] ) : [] );
        if ( !empty( $settings ) ) {
            update_option( 'radio_player_settings', $settings );
        }
        if ( !empty( $players ) ) {
            global $wpdb;
            $table = $wpdb->prefix . 'radio_player_players';
            $wpdb->query( "TRUNCATE TABLE {$table}" );
            foreach ( $players as $player ) {
                $this->update_player( $player );
            }
        }
        wp_send_json_success();
    }

    public function export_data() {
        // Check nonce
        if ( !check_ajax_referer( 'radio-player', 'nonce', false ) ) {
            wp_send_json_error( __( 'Invalid nonce', 'radio-player' ) );
        }
        // Check permission
        if ( !current_user_can( 'manage_options' ) ) {
            wp_send_json_error( __( 'You do not have permission to export data', 'radio-player' ) );
        }
        $type = ( !empty( $_POST['$type'] ) ? sanitize_text_field( $_POST['$type'] ) : 'all' );
        $export_data = array();
        // Settings
        if ( 'all' == $type || 'settings' == $type ) {
            $export_data['settings'] = radio_player_get_settings();
        }
        // Players
        if ( 'all' == $type || 'players' == $type ) {
            $export_data['players'] = radio_player_get_players();
        }
        wp_send_json_success( $export_data );
    }

    public function get_players() {
        // Check nonce
        if ( !check_ajax_referer( 'radio-player', 'nonce', false ) ) {
            wp_send_json_error( __( 'Invalid nonce', 'radio-player' ) );
        }
        // Check permission
        if ( !current_user_can( 'manage_options' ) ) {
            wp_send_json_error( __( 'You do not have permission to get players', 'radio-player' ) );
        }
        $page = ( !empty( $_POST['page'] ) ? intval( $_POST['page'] ) : 1 );
        $per_page = ( !empty( $_POST['per_page'] ) ? intval( $_POST['per_page'] ) : 999 );
        $order_by = ( !empty( $_POST['sort_by'] ) ? sanitize_text_field( $_POST['sort_by'] ) : 'created_at' );
        $order = ( !empty( $_POST['sort_order'] ) ? sanitize_text_field( $_POST['sort_order'] ) : 'desc' );
        $per_page = 10;
        $offset = 10 * ($page - 1);
        $limit = $per_page;
        global $wpdb;
        $table_name = $wpdb->prefix . 'radio_player_players';
        $sql = $wpdb->prepare( "SELECT * FROM {$table_name} ORDER BY {$order_by} {$order} LIMIT %d, %d", $offset, $limit );
        $players = $wpdb->get_results( $sql, ARRAY_A );
        $formatted_players = [];
        if ( !empty( $players ) ) {
            foreach ( $players as $player ) {
                $formatted_players[] = radio_player_get_formatted_player( $player );
            }
        }
        $count = count( $formatted_players );
        wp_send_json_success( [
            'players' => $formatted_players,
            'total'   => $count,
        ] );
    }

    public function update_player( $data = null ) {
        // Check nonce
        if ( !check_ajax_referer( 'radio-player', 'nonce', false ) ) {
            wp_send_json_error( __( 'Invalid nonce', 'radio-player' ) );
        }
        // Check permission
        if ( !current_user_can( 'manage_options' ) ) {
            wp_send_json_error( __( 'You do not have permission to update this player', 'radio-player' ) );
        }
        if ( !$data ) {
            $nonce = ( !empty( $_POST['nonce'] ) ? sanitize_text_field( $_POST['nonce'] ) : '' );
            if ( !wp_verify_nonce( $nonce, 'radio-player' ) ) {
                wp_send_json_error( __( 'Invalid nonce', 'radio-player' ) );
            }
        }
        $posted = ( !$data ? json_decode( base64_decode( $_POST['data'] ), 1 ) : $data );
        $id = ( !empty( $posted['id'] ) ? intval( $posted['id'] ) : 0 );
        $title = ( !empty( $posted['title'] ) ? sanitize_text_field( $posted['title'] ) : '' );
        $status = ( !empty( $posted['status'] ) ? 1 : 0 );
        $config = ( !empty( $posted['config'] ) ? $posted['config'] : $posted );
        global $wpdb;
        $table = $wpdb->prefix . 'radio_player_players';
        $insert_data = [
            'title'  => $title,
            'status' => $status,
            'config' => serialize( $config ),
        ];
        if ( $id > 0 ) {
            $insert_data['id'] = $id;
        }
        if ( $id > 0 && empty( $data ) ) {
            $wpdb->update( $table, $insert_data, [
                'id' => $id,
            ] );
        } else {
            $wpdb->insert( $table, $insert_data );
            $id = $wpdb->insert_id;
        }
        $insert_data['id'] = $id;
        $insert_data['config'] = $posted;
        if ( !empty( $data ) ) {
            return $insert_data;
        }
        wp_send_json_success( $insert_data );
    }

    public function delete_player() {
        // Check nonce
        if ( !check_ajax_referer( 'radio-player', 'nonce', false ) ) {
            wp_send_json_error( __( 'Invalid nonce', 'radio-player' ) );
        }
        if ( !current_user_can( 'manage_options' ) ) {
            wp_send_json_error( __( 'You do not have permission to delete this player', 'radio-player' ) );
        }
        $player_id = ( !empty( $_POST['id'] ) ? intval( $_POST['id'] ) : '' );
        global $wpdb;
        $table = $wpdb->prefix . 'radio_player_players';
        $wpdb->delete( $table, [
            'id' => $player_id,
        ] );
        wp_send_json_success( [
            'success' => true,
        ] );
    }

    public function update_settings() {
        // Check nonce
        if ( !check_ajax_referer( 'radio-player', 'nonce', false ) ) {
            wp_send_json_error( __( 'Invalid nonce', 'radio-player' ) );
        }
        // Check permission
        if ( !current_user_can( 'manage_options' ) ) {
            wp_send_json_error( __( 'You do not have permission to update settings', 'radio-player' ) );
        }
        $data = ( !empty( $_POST['data'] ) ? rp_sanitize_array( $_POST['data'] ) : array() );
        update_option( 'radio_player_settings', $data );
        wp_send_json_success( [
            'success' => true,
        ] );
    }

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}

Radio_Player_Ajax::instance();