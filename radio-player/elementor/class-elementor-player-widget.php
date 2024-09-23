<?php

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit();

class Radio_Player_Elementor_Widget extends Widget_Base {

	public function get_name() {
		return 'radio_player';
	}

	public function get_title() {
		return __( 'Radio Player', 'radio-player' );
	}

	public function get_icon() {
		return 'eicon-play';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'audio', 'radio', 'music', 'radio-player', 'radio player' ];
	}

	public function register_controls() {

		$this->start_controls_section( '_section_radio_player',
			[
				'label' => __( 'Radio Player', 'radio-player' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			] );


		$players = radio_player_get_players();

		if ( ! empty( $players ) ) {
			$players = wp_list_pluck( $players, 'title', 'id' );
		} else {
			$players = [ '' => __( 'No Player Found', 'radio-player' ) ];
		}

		$this->add_control( 'player_id',
			[
				'label'       => __( 'Select Player', 'radio-player' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'default'     => 0,
				'options'     => [ 0 => __( 'Select Player', 'radio-player' ) ] + $players,
			] );

		//Add align control
		$this->add_control(
			'align',
			[
				'label'     => __( 'Alignment', 'radio-player' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'radio-player' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'radio-player' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'radio-player' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
			]
		);


		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->get_settings_for_display();

		$id    = ! empty( $settings['player_id'] ) ? $settings['player_id'] : 0;
		$align = ! empty( $settings['align'] ) ? $settings['align'] : 'center';

		if ( empty( $id ) ) {
			echo '<p style="padding: 20px;border: 1px solid #ddd;margin: 20px;font-size: 1.5rem;font-weight: bold;border-radius: 0.3rem;text-align: center;">' . __( 'Please select a player.', 'radio-player' ) . '</p>';
		} else {
			printf( '<div class="align%s">%s</div>', $align, do_shortcode( "[radio_player id=$id]" ) );
		}
	}

}