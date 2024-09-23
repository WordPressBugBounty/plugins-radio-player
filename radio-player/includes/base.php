<?php

defined( 'ABSPATH' ) || exit;
final class Radio_Player {
    /**
     * Minimum PHP version required
     *
     * @var string
     */
    private $min_php = '5.6.0';

    /**
     * The single instance of the class.
     *
     * @var Radio_Player
     * @since 1.0.0
     */
    protected static $instance = null;

    /**
     * Radio_Player constructor.
     */
    public function __construct() {
        $this->check_environment();
        $this->includes();
        $this->init_hooks();
        register_activation_hook( RADIO_PLAYER_FILE, array($this, 'activate') );
        do_action( 'radio_player_loaded' );
    }

    public function activate() {
        if ( !class_exists( 'Radio_Player_Install' ) ) {
            include_once RADIO_PLAYER_INCLUDES . '/class-install.php';
        }
        Radio_Player_Install::activate();
    }

    /**
     * Ensure theme and server variable compatibility
     *
     * @return void
     * @since 1.0.0
     *
     */
    public function check_environment() {
        if ( version_compare( PHP_VERSION, $this->min_php, '<=' ) ) {
            deactivate_plugins( plugin_basename( RADIO_PLAYER_FILE ) );
            wp_die( "Unsupported PHP version Min required PHP Version:{$this->min_php}" );
        }
    }

    /**
     * Include required core files used in admin and on the frontend.
     *
     * @return void
     * @since 1.0.0
     *
     */
    public function includes() {
        // Core includes
        include_once RADIO_PLAYER_INCLUDES . '/functions.php';
        include_once RADIO_PLAYER_INCLUDES . '/class-enqueue.php';
        include_once RADIO_PLAYER_INCLUDES . '/class-hooks.php';
        include_once RADIO_PLAYER_INCLUDES . '/class-shortcode.php';
        include_once RADIO_PLAYER_INCLUDES . '/class-ajax.php';
        require_once RADIO_PLAYER_INCLUDES . '/class-player-locations.php';
        require_once RADIO_PLAYER_INCLUDES . '/class-stream-data.php';
        // Elementor
        require_once RADIO_PLAYER_PATH . '/elementor/class-elementor.php';
        // Block
        include_once RADIO_PLAYER_PATH . '/block/class-block.php';
        // Admin includes
        if ( is_admin() ) {
            include_once RADIO_PLAYER_INCLUDES . '/class-admin.php';
        }
    }

    /**
     * Hook into actions and filters.
     *
     * @since 1.0.0
     */
    private function init_hooks() {
        add_action( 'admin_notices', [$this, 'print_notices'], 15 );
        //Localize our plugin
        add_action( 'init', [$this, 'localization_setup'] );
    }

    /**
     * Initialize plugin for localization
     *
     * @return void
     * @since 1.0.0
     *
     */
    public function localization_setup() {
        load_plugin_textdomain( 'radio-player', false, dirname( plugin_basename( RADIO_PLAYER_FILE ) ) . '/languages/' );
    }

    public function add_notice( $class, $message ) {
        $notices = get_option( sanitize_key( 'radio_player_notices' ), [] );
        if ( is_string( $message ) && is_string( $class ) && !wp_list_filter( $notices, array(
            'message' => $message,
        ) ) ) {
            $notices[] = array(
                'message' => $message,
                'class'   => $class,
            );
            update_option( sanitize_key( 'radio_player_notices' ), $notices );
        }
    }

    /**
     * Prince admin notice
     *
     * @return void
     * @since 1.0.0
     *
     */
    public function print_notices() {
        $notices = get_option( sanitize_key( 'radio_player_notices' ), [] );
        foreach ( $notices as $notice ) {
            ?>
            <div
                    class="notice notice-large is-dismissible radio-player-admin-notice notice-<?php 
            echo esc_attr( $notice['class'] );
            ?>">
				<?php 
            echo $notice['message'];
            ?>
            </div>
			<?php 
            update_option( sanitize_key( 'radio_player_notices' ), [] );
        }
    }

    /**
     * Main Radio_Player Instance.
     *
     * Ensures only one instance of Radio_Player is loaded or can be loaded.
     *
     * @return Radio_Player - Main instance.
     * @since 1.0.0
     * @static
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}

// kickoff radio_player
if ( !function_exists( 'radio_player' ) ) {
    function radio_player() {
        return Radio_Player::instance();
    }

}
radio_player();