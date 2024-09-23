<?php

defined( 'ABSPATH' ) || exit;
class Radio_Player_Shortcode {
    /**
     * @var null
     */
    private static $instance = null;

    /**
     * Radio_Player_Shortcode constructor.
     */
    public function __construct() {
        add_action( 'plugins_loaded', array($this, 'replace_radio_player_shortcode') );
    }

    public function replace_radio_player_shortcode() {
        remove_shortcode( 'radio_player' );
        add_shortcode( 'radio_player', array($this, 'render_player') );
    }

    /**
     * @param $atts
     *
     * @return false|string|void
     * @since 1.0.0
     */
    public function render_player( $atts ) {
        $is_preview = isset( $_GET['preview'] );
        $atts = shortcode_atts( array(
            'id'          => '',
            'player_type' => 'shortcode',
        ), $atts );
        $id = intval( $atts['id'] );
        $player = radio_player_get_players( $id );
        if ( empty( $player['status'] ) ) {
            if ( !$is_preview || $is_preview && !current_user_can( 'edit_posts' ) ) {
                return;
            }
        }
        $config = $player['config'];
        if ( !$is_preview && rp_fs()->can_use_premium_code__premium_only() ) {
            if ( !$this->check_schedule__premium_only( $config ) ) {
                return;
            }
        }
        $config['id'] = $id;
        // Enqueue frontend scripts
        Radio_Player_Enqueue::instance()->frontend_scripts();
        return sprintf( '<div class="radio_player" data-player-type="%1$s"data-data="%2$s"></div>', esc_attr( $atts['player_type'] ), esc_attr( base64_encode( json_encode( $config ) ) ) );
    }

    private function is_current_time_in_range( $start, $end, $current ) {
        // Converts a time to a float, eg. '20:30' becomes '20.5'
        $start = $this->time_to_decimal( $start );
        $end = $this->time_to_decimal( $end );
        $current = $this->time_to_decimal( $current );
        // Check if current time is within a range
        if ( $start <= $end ) {
            return $current >= $start && $current <= $end;
        } else {
            // If the start time is greater than the end time, it means the range extends to the next day
            return $current >= $start || $current <= $end;
        }
    }

    private function time_to_decimal( $time ) {
        $parts = explode( ":", $time );
        return $parts[0] + $parts[1] / 60;
    }

    /**
     * @return Radio_Player_Shortcode|null
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}

Radio_Player_Shortcode::instance();