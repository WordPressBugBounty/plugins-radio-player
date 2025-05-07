<?php

/**
 * Plugin Name: Radio Player
 * Plugin URI:  https://softlabbd.com/radio-player
 * Description: Adds live audio streaming to WordPress, supporting Shoutcast, Icecast, and more for easy broadcasting.
 * Version:     2.0.88
 * Author:      SoftLab
 * Author URI:  https://softlabbd.com/
 * Text Domain: radio-player
 * Domain Path: /languages/
 */
if ( !defined( 'ABSPATH' ) ) {
    exit( 'You can\'t access this page directly.' );
}
// Freemius SDK check
if ( !function_exists( 'rp_fs' ) ) {
    function rp_fs() {
        global $rp_fs;
        if ( !isset( $rp_fs ) ) {
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $rp_fs = fs_dynamic_init( [
                'id'             => '8684',
                'slug'           => 'radio-player',
                'type'           => 'plugin',
                'public_key'     => 'pk_6175576896c0d8c125d31e42287ab',
                'is_premium'     => false,
                'premium_suffix' => 'PRO',
                'has_addons'     => true,
                'has_paid_plans' => true,
                'trial'          => [
                    'days'               => 3,
                    'is_require_payment' => true,
                ],
                'menu'           => [
                    'slug'       => 'radio-player',
                    'first-path' => 'admin.php?page=radio-player-getting-started',
                    'contact'    => false,
                    'support'    => false,
                ],
                'is_live'        => true,
            ] );
        }
        return $rp_fs;
    }

    rp_fs();
    do_action( 'rp_fs_loaded' );
}
// Define plugin constants
define( 'RADIO_PLAYER_VERSION', '2.0.88' );
define( 'RADIO_PLAYER_FILE', __FILE__ );
define( 'RADIO_PLAYER_PATH', dirname( RADIO_PLAYER_FILE ) );
define( 'RADIO_PLAYER_INCLUDES', RADIO_PLAYER_PATH . '/includes' );
define( 'RADIO_PLAYER_URL', plugins_url( '', RADIO_PLAYER_FILE ) );
define( 'RADIO_PLAYER_ASSETS', RADIO_PLAYER_URL . '/assets' );
define( 'RADIO_PLAYER_TEMPLATES', RADIO_PLAYER_PATH . '/templates' );
// Load main plugin class
include_once RADIO_PLAYER_INCLUDES . '/class-main.php';