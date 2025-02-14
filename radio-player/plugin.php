<?php

/**
 * Plugin Name: Radio Player
 * Plugin URI:  https://softlabbd.com/radio-player
 * Description: Adds live audio streaming to WordPress, supporting Shoutcast, Icecast, and more for easy broadcasting.
 * Version:     2.0.83
 * Author:      SoftLab
 * Author URI:  https://softlabbd.com/
 * Text Domain: radio-player
 * Domain Path: /languages/
 */
// don't call the file directly
if ( !defined( 'ABSPATH' ) ) {
    wp_die( __( 'You can\'t access this page', 'radio-player' ) );
}
// check wp version
if ( !version_compare( get_bloginfo( 'version' ), '5.0', '>=' ) ) {
    $notice = sprintf( '%1$s requires WordPress version %2$s or greater. Please update your WordPress to the latest version.', '<strong>Radio Player</strong>', '<strong>5.0</strong>' );
    add_action( 'admin_notices', function () use($notice) {
        ?>
        <div class="notice is-dismissible notice-error">
            <p><?php 
        echo $notice;
        ?></p>
        </div>
	<?php 
    } );
    add_action( 'after_plugin_row_radio-player/plugin.php', function () use($notice) {
        ?>
        <tr class="plugin-update-tr active">
            <td class="plugin-update colspanchange" colspan="4">
                <div class="update-message notice inline notice-error notice-alt">
                    <p><?php 
        echo $notice;
        ?></p>
                </div>
            </td>
        </tr>
	<?php 
    } );
} else {
    if ( function_exists( 'rp_fs' ) ) {
        rp_fs()->set_basename( false, __FILE__ );
    } else {
        // DO NOT REMOVE THIS IF, IT IS ESSENTIAL FOR THE `function_exists` CALL ABOVE TO PROPERLY WORK.
        if ( !function_exists( 'rp_fs' ) ) {
            // Create a helper function for easy SDK access.
            function rp_fs() {
                global $rp_fs;
                if ( !isset( $rp_fs ) ) {
                    // Include Freemius SDK.
                    require_once dirname( __FILE__ ) . '/freemius/start.php';
                    $rp_fs = fs_dynamic_init( array(
                        'id'             => '8684',
                        'slug'           => 'radio-player',
                        'type'           => 'plugin',
                        'public_key'     => 'pk_6175576896c0d8c125d31e42287ab',
                        'is_premium'     => false,
                        'premium_suffix' => 'PRO',
                        'has_addons'     => true,
                        'has_paid_plans' => true,
                        'trial'          => array(
                            'days'               => 3,
                            'is_require_payment' => true,
                        ),
                        'menu'           => array(
                            'slug'       => 'radio-player',
                            'first-path' => 'admin.php?page=radio-player-getting-started',
                            'contact'    => false,
                            'support'    => false,
                        ),
                        'is_live'        => true,
                    ) );
                }
                return $rp_fs;
            }

            // Init Freemius.
            rp_fs();
            // Signal that SDK was initiated.
            do_action( 'rp_fs_loaded' );
        }
        // ... Your plugin's main file logic ...
        /** define constants */
        define( 'RADIO_PLAYER_VERSION', '2.0.83' );
        define( 'RADIO_PLAYER_FILE', __FILE__ );
        define( 'RADIO_PLAYER_PATH', dirname( RADIO_PLAYER_FILE ) );
        define( 'RADIO_PLAYER_INCLUDES', RADIO_PLAYER_PATH . '/includes' );
        define( 'RADIO_PLAYER_URL', plugins_url( '', RADIO_PLAYER_FILE ) );
        define( 'RADIO_PLAYER_ASSETS', RADIO_PLAYER_URL . '/assets' );
        define( 'RADIO_PLAYER_TEMPLATES', RADIO_PLAYER_PATH . '/templates' );
        // Show Radio Player Ads Addon Update Notice
        if ( get_option( 'radio_player_ads_notice', false ) ) {
            add_action( 'admin_notices', function () {
                $notice = sprintf( esc_html__( '"%1$s" - addon is deactivated. Please update your %1$s addon plugin to the latest version (v%2$s)', 'radio-player' ), '<strong>Radio Player Ads</strong>', '<strong>' . esc_html__( '1.0.1', 'radio-player' ) . '</strong>' );
                ?>
                <div class="notice is-dismissible notice-error radio-player-admin-notice">
                    <p><?php 
                echo $notice;
                ?></p>
                </div>
			<?php 
            } );
        }
        //Include the base plugin file.
        include_once RADIO_PLAYER_INCLUDES . '/base.php';
    }
}