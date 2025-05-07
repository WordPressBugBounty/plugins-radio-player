<?php

defined( 'ABSPATH' ) || exit;
class Radio_Player_Enqueue {
    /**
     * @var null
     */
    private static $instance = null;

    /**
     * Radio_Player_Enqueue constructor.
     */
    public function __construct() {
        if ( !empty( radio_player_get_setting( 'stickyTriggers' ) ) ) {
            add_action( 'wp_enqueue_scripts', [$this, 'frontend_scripts'] );
        }
        add_action( 'admin_enqueue_scripts', [$this, 'admin_enqueue'] );
    }

    /**
     * Frontend Scripts
     *
     * @param $hook
     *
     * @return void
     * @since 1.0.0
     */
    public function frontend_scripts() {
        wp_enqueue_style(
            'radio-player',
            RADIO_PLAYER_ASSETS . '/css/frontend.css',
            [],
            RADIO_PLAYER_VERSION
        );
        wp_add_inline_style( 'radio-player', $this->get_custom_css() );
        wp_style_add_data( 'radio-player', 'rtl', 'replace' );
        $deps = [
            'react',
            'react-dom',
            'wp-i18n',
            'jquery',
            'wp-util'
        ];
        wp_register_script(
            'radio-player-hls',
            RADIO_PLAYER_ASSETS . '/vendor/hls.min.js',
            [],
            false,
            true
        );
        $deps[] = 'radio-player-hls';
        /* enqueue frontend script */
        wp_enqueue_script(
            'radio-player',
            RADIO_PLAYER_ASSETS . '/js/frontend.js',
            $deps,
            RADIO_PLAYER_VERSION,
            true
        );
        /* localized script attached to 'wp-radio' */
        wp_localize_script( 'radio-player', 'radioPlayer', $this->get_localized_data() );
        // set js translation text-domain
        wp_set_script_translations( 'radio-player', 'radio-player', RADIO_PLAYER_PATH . '/languages' );
        do_action( 'radio_player/frontend_scripts' );
    }

    /**
     * Admin Scripts
     *
     * @param $hook
     *
     * @return void
     * @since 1.0.0
     */
    public function admin_enqueue( $hook ) {
        //admin styles
        wp_enqueue_style( 'sweetalert2', RADIO_PLAYER_ASSETS . '/vendor/sweetalert2/sweetalert2.min.css' );
        wp_enqueue_style(
            'radio-player-admin',
            RADIO_PLAYER_ASSETS . '/css/admin.css',
            ['wp-components'],
            RADIO_PLAYER_VERSION
        );
        wp_style_add_data( 'radio-player-admin', 'rtl', 'replace' );
        /**---- admin scripts -----*/
        $deps = array('wp-element', 'wp-components', 'wp-util');
        $page = ( isset( $_GET['page'] ) ? $_GET['page'] : '' );
        wp_register_script(
            'sweetalert2',
            RADIO_PLAYER_ASSETS . '/vendor/sweetalert2/sweetalert2.min.js',
            [],
            '11.4.8',
            true
        );
        $deps[] = 'sweetalert2';
        if ( 'radio-player' == $page ) {
            wp_enqueue_media();
        }
        if ( 'radio-player-settings' == $page ) {
            // Tinymce editor
            wp_enqueue_media();
            wp_enqueue_editor();
            // Code editor
            wp_enqueue_script( 'wp-theme-plugin-editor' );
            wp_enqueue_style( 'wp-codemirror' );
            wp_enqueue_code_editor( array(
                'type' => 'text/css',
            ) );
        }
        if ( $page == 'radio-player-statistics' || 'index.php' === $hook ) {
            wp_enqueue_script(
                'radio-player-chart',
                RADIO_PLAYER_ASSETS . '/vendor/Chart.bundle.min.js',
                ['jquery-ui-datepicker'],
                '2.8.0',
                true
            );
        }
        wp_register_script(
            'radio-player-hls',
            RADIO_PLAYER_ASSETS . '/vendor/hls.min.js',
            [],
            false,
            true
        );
        $deps[] = 'radio-player-hls';
        // Radio player admin
        wp_enqueue_script(
            'radio-player-admin',
            RADIO_PLAYER_ASSETS . '/js/admin.js',
            $deps,
            RADIO_PLAYER_VERSION,
            true
        );
        wp_localize_script( 'radio-player-admin', 'radioPlayer', $this->get_localized_data() );
        // Set js translation text-domain
        wp_set_script_translations( 'radio-player-admin', 'radio-player', RADIO_PLAYER_PATH . '/languages' );
    }

    public function get_localized_data() {
        $data = array(
            'plugin_url'             => RADIO_PLAYER_URL,
            'admin_url'              => admin_url(),
            'ajax_url'               => admin_url( 'admin-ajax.php' ),
            'site_url'               => home_url(),
            'popup_url'              => str_replace( 'https', 'http', site_url() ),
            'nonce'                  => wp_create_nonce( 'radio-player' ),
            'isPro'                  => rp_fs()->can_use_premium_code__premium_only(),
            'settings'               => radio_player_get_settings(),
            'can_ads_player'         => function_exists( 'rpa_fs' ) && rpa_fs()->can_use_premium_code__premium_only(),
            'can_proxy_player_addon' => function_exists( 'rpp_fs' ) && rpp_fs()->can_use_premium_code__premium_only(),
        );
        if ( is_admin() ) {
            $data['is_admin'] = is_admin();
            $data['upgrade_url'] = rp_fs()->get_upgrade_url();
            $data['addons_url'] = rp_fs()->get_addons_url();
            $data['showReviewPopup'] = current_user_can( 'manage_options' ) && 'off' != get_option( 'radio_player_rating_notice' ) && 'off' != get_transient( 'radio_player_rating_notice_interval' );
        } else {
            if ( !empty( radio_player_get_setting( 'stickyTriggers' ) ) ) {
                $data['players'] = radio_player_get_players();
            }
        }
        return $data;
    }

    public function get_custom_css() {
        $css = '';
        //metaDataTextSpeed
        $metaDataTextSpeed = radio_player_get_setting( 'metaDataTextSpeed', 10 );
        if ( 'disabled' !== $metaDataTextSpeed ) {
            $css .= 'div.radio-player .radio-player-song-title span.track-title { animation-duration: ' . $metaDataTextSpeed . 's; }';
        }
        $custom_css = radio_player_get_setting( 'customCSS' );
        $css .= $custom_css;
        return $css;
    }

    /**
     * @return Radio_Player_Enqueue|null
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}

Radio_Player_Enqueue::instance();