<?php

defined( 'ABSPATH' ) || exit;
class Radio_Player_Admin {
    /** @var null */
    private static $instance = null;

    public $admin_pages = [];

    public function __construct() {
        add_action( 'admin_menu', [$this, 'admin_menu'] );
        add_action( 'admin_init', [$this, 'init_update'] );
        add_action( 'wp_ajax_radio_player_hide_recommended_plugins', [$this, 'hide_recommended_plugins'] );
        add_action( 'admin_notices', [$this, 'display_notices'] );
        // handle offer notice dismiss
        add_action( 'wp_ajax_rp_dismiss_offer_notice', [$this, 'dismiss_offer_notice'] );
        // Hide proxy player addon notice
        add_action( 'wp_ajax_rp_hide_radio_player_proxy_addon_notice', [$this, 'hide_proxy_player_addon_notice'] );
    }

    public function hide_proxy_player_addon_notice() {
        update_option( 'radio_player_proxy_addon_notice', 'off' );
        wp_send_json_success();
    }

    public function display_notices() {
        // Offer Notice
        $offer = $this->get_offer_notice();
        if ( !empty( $offer ) ) {
            $offer_html = $offer['html'];
            radio_player()->add_notice( 'info radio-player-offer-notice', $offer_html );
            return;
        }
        // Proxy Player Notice
        if ( 'off' != get_option( 'radio_player_proxy_addon_notice' ) && !function_exists( 'rpp_fs' ) ) {
            ob_start();
            include RADIO_PLAYER_INCLUDES . '/views/notice/radio-player-proxy-addon.php';
            $notice_html = ob_get_clean();
            radio_player()->add_notice( 'info  radio-player-proxy-addon-notice', $notice_html );
            return;
        }
    }

    public function get_offer_notice() {
        // Check if pro plan
        $license = rp_fs()->_get_license();
        if ( !empty( $license ) ) {
            return false;
        }
        $admin_pages = $this->admin_pages;
        global $current_screen;
        if ( !is_object( $current_screen ) || !in_array( $current_screen->id, $admin_pages ) ) {
            return false;
        }
        $offer = get_transient( 'radio_player_offer_notice' );
        if ( false === $offer ) {
            // URL of the API on your server that returns offer data.
            $api_url = 'https://softlabbd.com/offers.php?plugin=radio-player';
            // Send GET request to your server to get offer data.
            $response = wp_remote_get( $api_url );
            // Check for errors.
            if ( is_wp_error( $response ) ) {
                return;
            }
            // Parse the response body.
            $offer_json = wp_remote_retrieve_body( $response );
            $offer = json_decode( $offer_json, true );
            set_transient( 'radio_player_offer_notice', $offer, DAY_IN_SECONDS );
        }
        if ( empty( $offer ) ) {
            return;
        }
        if ( !empty( $offer['dismissed'] ) ) {
            return;
        }
        $start_date = strtotime( $offer['start_date'] );
        $end_date = strtotime( $offer['end_date'] );
        $current_date = strtotime( date( 'Y-m-d' ) );
        if ( $current_date < $start_date || $current_date > $end_date ) {
            return false;
        }
        return $offer;
    }

    public function dismiss_offer_notice() {
        $offer = get_transient( 'radio_player_offer_notice' );
        if ( false !== $offer ) {
            $offer['dismissed'] = true;
            set_transient( 'radio_player_offer_notice', $offer, 3 * DAY_IN_SECONDS );
        }
    }

    public function hide_recommended_plugins() {
        update_option( "radio_player_hide_recommended_plugin", true );
        wp_send_json_success();
    }

    public function init_update() {
        if ( !class_exists( 'Radio_Player_Update' ) ) {
            include_once RADIO_PLAYER_INCLUDES . '/class-update.php';
        }
        $updater = new Radio_Player_Update();
        if ( $updater->needs_update() ) {
            $updater->perform_updates();
        }
    }

    /**
     * Add admin menu
     * @since 1.0.0
     */
    public function admin_menu() {
        $slug = 'radio-player';
        $capability = 'manage_options';
        $this->admin_pages['players_page'] = add_menu_page(
            __( 'Radio Player', 'radio-player' ),
            __( 'Radio Player', 'radio-player' ),
            $capability,
            $slug,
            [$this, 'render_radio_player_page'],
            RADIO_PLAYER_ASSETS . '/images/play.svg',
            59
        );
        // All players page
        $this->admin_pages['players_page'] = add_submenu_page(
            $slug,
            __( 'All Players', 'radio-player' ),
            __( 'All Players', 'radio-player' ),
            $capability,
            'radio-player'
        );
        // Getting started page
        $this->admin_pages['getting_started_page'] = add_submenu_page(
            $slug,
            __( 'Getting Started - Radio Player', 'radio-player' ),
            __( 'Getting Started', 'radio-player' ),
            $capability,
            'radio-player-getting-started',
            [$this, 'render_getting_started_page']
        );
        // Settings page
        $this->admin_pages['settings_page'] = add_submenu_page(
            $slug,
            __( 'Settings - Radio Player', 'radio-player' ),
            __( 'Settings', 'radio-player' ),
            $capability,
            'radio-player-settings',
            [$this, 'render_settings_page'],
            10
        );
        // Recommended plugins page
        if ( empty( get_option( "radio_player_hide_recommended_plugin" ) ) ) {
            $this->admin_pages['recommended_plugins_page'] = add_submenu_page(
                $slug,
                esc_html__( 'Recommended Plugins', 'radio-player' ),
                esc_html__( 'Recommended Plugins', 'radio-player' ),
                $capability,
                'radio-player-recommended-plugins',
                [$this, 'render_recommended_plugins_page']
            );
        }
    }

    public function render_recommended_plugins_page() {
        include RADIO_PLAYER_INCLUDES . '/views/recommended-plugins.php';
    }

    public function render_radio_player_page() {
        echo "<div id='radio-player-app'></div>";
    }

    /**
     * Get started page callback
     *
     * @since 1.0.0
     */
    public function render_getting_started_page() {
        include RADIO_PLAYER_INCLUDES . '/views/getting-started/index.php';
    }

    public function render_settings_page() {
        ?>
        <script>
            const adminEmail = '<?php 
        echo get_option( 'admin_email' );
        ?>';

			<?php 
        ?>

        </script>

        <div id="radio-player-settings" class="radio-player-settings"></div>
	<?php 
    }

    /**
     * @return Radio_Player_Admin|null
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}

Radio_Player_Admin::instance();