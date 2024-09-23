<div class="wrap">

	<h1 class="wp-heading-inline statistics-page-heading">
		<i class="dashicons dashicons-chart-bar"></i>
		<?php 
_e( 'Statistics', 'radio-player' );
?>
	</h1>

	<div class="statistics-description">
		<p><?php 
esc_html_e( 'Overview of how many listeners are listening the radio players in each day and get the list of top played radio players.', 'radio-player' );
?></p>
	</div>


	<?php 
if ( !class_exists( 'Radio_Player_Statistics' ) ) {
    include_once RADIO_PLAYER_INCLUDES . '/class-statistics__premium_only.php';
}
$args = [
    'start_date' => ( !empty( $_GET['start_date'] ) ? sanitize_text_field( $_GET['start_date'] ) : date( 'Y-m-d', strtotime( '-1 month' ) ) ),
    'end_date'   => ( !empty( $_GET['end_date'] ) ? sanitize_text_field( $_GET['end_date'] ) : date( 'Y-m-d' ) ),
];
if ( !empty( $_REQUEST['start_date'] ) ) {
    $args['start_date'] = sanitize_text_field( $_REQUEST['start_date'] );
}
if ( !empty( $_REQUEST['end_date'] ) ) {
    $args['end_date'] = sanitize_text_field( $_REQUEST['end_date'] );
}
$statistics = Radio_Player_Statistics::instance( $args );
?>

	<div class="statistics-wrap">
		<?php 
$statistics->filter_bar();
$statistics->chart();
$statistics->top_players();
?>
			<div class="radio-player-dash-widget-wrapper">
				<div class="radio-player-dash-widget">
					<h2><?php 
_e( 'View radio player statistics', 'radio-player' );
?></h2>
					<p><?php 
_e( 'Upgrade to Pro and get access to the stats.', 'radio-player' );
?></p>
					<p>
						<a href="<?php 
echo rp_fs()->get_upgrade_url();
?>"
						   class="button button-primary"><?php 
_e( 'Upgrade Now', 'radio-player' );
?></a>
					</p>

				</div>
			</div>
		<?php 
?>
	</div>

</div>