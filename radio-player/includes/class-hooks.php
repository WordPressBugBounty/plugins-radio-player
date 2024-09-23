<?php

defined( 'ABSPATH' ) || exit;
class Radio_Player_Hooks {
    /** @var null */
    private static $instance = null;

    /**
     * Radio_Player_Hooks constructor.
     */
    public function __construct() {
        // Render the footer sticky player
        add_action( 'wp_footer', [$this, 'render_player'] );
        // filter query args
        add_filter( 'query_vars', [$this, 'add_query_vars'] );
        // Popup player
        add_action( 'template_redirect', [$this, 'render_popup_player'] );
    }

    public function add_query_vars( $vars ) {
        $vars[] = 'radio_player';
        return $vars;
    }

    /**
     * Render footer sticky player
     *
     * @since 1.0.0
     */
    public function render_player() {
    }

    /**
     * Render the popup player
     *
     * @since 1.0.0
     */
    public function render_popup_player() {
        if ( get_query_var( 'radio_player' ) ) {
            $player_id = intval( get_query_var( 'radio_player' ) );
            $player = radio_player_get_players( $player_id );
            $player_type = 'popup';
            add_filter( 'show_admin_bar', '__return_false' );
            // Remove all WordPress actions
            remove_all_actions( 'wp_head' );
            remove_all_actions( 'wp_print_styles' );
            remove_all_actions( 'wp_print_head_scripts' );
            remove_all_actions( 'wp_footer' );
            // Handle `wp_head`
            add_action( 'wp_head', 'wp_enqueue_scripts', 1 );
            add_action( 'wp_head', 'wp_print_styles', 8 );
            add_action( 'wp_head', 'wp_print_head_scripts', 9 );
            add_action( 'wp_head', 'wp_site_icon' );
            remove_action( 'wp_head', 'wp_auth_check_load' );
            // Handle `wp_footer`
            add_action( 'wp_footer', 'wp_print_footer_scripts', 20 );
            // Handle `wp_enqueue_scripts`
            remove_all_actions( 'wp_enqueue_scripts' );
            // Also remove all scripts hooked into after_wp_tiny_mce.
            remove_all_actions( 'after_wp_tiny_mce' );
            $is_preview = isset( $_GET['preview'] );
            $header_content = radio_player_get_setting( 'popupHeaderContent' );
            $footer_content = radio_player_get_setting( 'popupFooterContent' );
            ?>

            <!doctype html>
            <html lang="<?php 
            language_attributes();
            ?>">
            <head>
                <meta charset="<?php 
            bloginfo( 'charset' );
            ?>">
                <meta name="viewport"
                      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title><?php 
            echo $player['title'];
            ?></title>

				<?php 
            wp_enqueue_style( 'google-font-roboto', 'https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap' );
            ?>

				<?php 
            do_action( 'wp_head' );
            ?>

            </head>

            <body class="radio-player-popup-player-wrap">

			<?php 
            if ( !$is_preview && !empty( $header_content ) ) {
                printf( '<div class="radio-player-popup-header">%s</div>', do_shortcode( $header_content ) );
            }
            ?>

			<?php 
            echo do_shortcode( '[radio_player id="' . $player_id . '" player_type="' . $player_type . '" ]' );
            ?>

			<?php 
            if ( !$is_preview && !empty( $footer_content ) ) {
                printf( '<div class="radio-player-popup-footer">%s</div>', do_shortcode( $footer_content ) );
            }
            ?>

			<?php 
            do_action( 'wp_footer' );
            ?>

            </body>
            </html>

			<?php 
            exit;
        }
    }

    /**
     * @return Radio_Player_Hooks|null
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}

Radio_Player_Hooks::instance();