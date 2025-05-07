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
        // Add rewrite rules
        add_action( 'init', [$this, 'add_rewrite_rules'] );
        // Filter query args
        add_filter( 'query_vars', [$this, 'add_query_vars'] );
        // Popup player
        add_action( 'template_redirect', [$this, 'render_popup_player'] );
        // Render preview player
        add_action( 'template_redirect', [$this, 'render_preview_player'] );
    }

    public function add_rewrite_rules() {
        add_rewrite_rule( '^radio-player/([0-9]+)/?$', 'index.php?radio-player=$matches[1]', 'top' );
    }

    public function add_query_vars( $vars ) {
        $vars[] = 'radio-player';
        $vars[] = 'radio_player';
        $vars[] = 'radio_player_play';
        return $vars;
    }

    public function render_preview_player() {
        $player_id = get_query_var( 'radio-player' );
        if ( !$player_id ) {
            return;
        }
        $id = esc_attr( $player_id );
        $player = radio_player_get_players( $id );
        if ( !$player ) {
            wp_die( esc_html__( 'Invalid player ID.', 'radio-player' ), 400 );
        }
        $title = $player['title'] ?? 'Radio Player';
        // Capture the shortcode output
        ob_start();
        echo do_shortcode( '[radio_player id="' . $id . '"]' );
        $post_content = ob_get_clean();
        global $wp_query, $post;
        // Create the fake post object
        $fake_post_data = [
            'ID'                => 0,
            'post_author'       => 0,
            'post_date'         => current_time( 'mysql' ),
            'post_date_gmt'     => current_time( 'mysql', 1 ),
            'post_modified'     => current_time( 'mysql' ),
            'post_modified_gmt' => current_time( 'mysql', 1 ),
            'post_content'      => $post_content,
            'post_title'        => $title,
            'post_excerpt'      => '',
            'post_status'       => 'publish',
            'post_type'         => 'page',
            'post_name'         => 'igd-modules',
            'post_parent'       => 0,
            'guid'              => home_url( '/?radio_player=' . $id ),
            'menu_order'        => 0,
            'ping_status'       => 'closed',
            'comment_status'    => 'closed',
            'comment_count'     => 0,
            'filter'            => 'raw',
        ];
        $post = new \WP_Post((object) $fake_post_data);
        // Set global WP_Query properties
        $wp_query->post = $post;
        $wp_query->posts = [$post];
        $wp_query->queried_object = $post;
        $wp_query->queried_object_id = $post->ID;
        $wp_query->post_count = 1;
        $wp_query->is_page = true;
        $wp_query->is_single = true;
        $wp_query->is_singular = true;
        $wp_query->is_home = false;
        $wp_query->is_404 = false;
        $wp_query->max_num_pages = 1;
        // Set up postdata
        setup_postdata( $post );
        // Optionally remove conflicting filters (if necessary)
        remove_all_filters( 'the_content' );
        remove_all_filters( 'the_excerpt' );
        remove_all_filters( 'the_title' );
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
        $player_id = get_query_var( 'radio_player', 0 );
        if ( !$player_id ) {
            return;
        }
        // Validate player ID strictly
        $player_id = intval( $player_id );
        if ( $player_id <= 0 ) {
            return;
        }
        // Verify if the player exists
        $player = radio_player_get_players( $player_id );
        if ( empty( $player ) ) {
            return;
        }
        $player_type = 'popup';
        add_filter( 'show_admin_bar', '__return_false' );
        // Remove all WordPress actions
        remove_all_actions( 'wp_head' );
        remove_all_actions( 'wp_print_styles' );
        remove_all_actions( 'wp_print_head_scripts' );
        remove_all_actions( 'wp_footer' );
        // Handle wp_head
        add_action( 'wp_head', 'wp_enqueue_scripts', 1 );
        add_action( 'wp_head', 'wp_print_styles', 8 );
        add_action( 'wp_head', 'wp_print_head_scripts', 9 );
        add_action( 'wp_head', 'wp_site_icon' );
        remove_action( 'wp_head', 'wp_auth_check_load' );
        // Handle wp_footer
        add_action( 'wp_footer', 'wp_print_footer_scripts', 20 );
        // Handle wp_enqueue_scripts
        remove_all_actions( 'wp_enqueue_scripts' );
        // Also remove all scripts hooked into after_wp_tiny_mce.
        remove_all_actions( 'after_wp_tiny_mce' );
        $is_preview = isset( $_GET['preview'] ) && $_GET['preview'] === 'true';
        $header_content = radio_player_get_setting( 'popupHeaderContent' );
        $footer_content = radio_player_get_setting( 'popupFooterContent' );
        ?>

        <!doctype html>
        <html <?php 
        language_attributes();
        ?>>
        <head>
            <meta charset="<?php 
        bloginfo( 'charset' );
        ?>">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title><?php 
        echo esc_html( $player['title'] );
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
            printf( '<div class="radio-player-popup-header">%s</div>', do_shortcode( wp_kses_post( $header_content ) ) );
        }
        ?>

		<?php 
        echo do_shortcode( '[radio_player id="' . esc_attr( $player_id ) . '" player_type="' . esc_attr( $player_type ) . '" ]' );
        ?>

		<?php 
        if ( !$is_preview && !empty( $footer_content ) ) {
            printf( '<div class="radio-player-popup-footer">%s</div>', do_shortcode( wp_kses_post( $footer_content ) ) );
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