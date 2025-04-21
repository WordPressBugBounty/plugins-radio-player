<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<div class="email-wrap" style="background:#f6f8fb;padding:40px 0;">
    <table align="center" cellpadding="0" cellspacing="0" width="100%"
           style="max-width:720px; margin:auto; background:#ffffff; border-radius:6px; overflow:hidden; box-shadow:0 2px 5px rgba(0,0,0,0.05); font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;">

        <!-- Header -->
        <tr>
            <td style="background:#2E86DE;padding:24px 30px;text-align:center;">
                <h1 style="color:#fff;font-size:22px;font-weight:700;margin:0;text-transform:uppercase;">
					<?php esc_html_e( 'Radio Player Statistics — Last', 'radio-player' ); ?>
					<?php printf( _n( '%s Day', '%s Days', $length, 'radio-player' ), $length ); ?>
                </h1>
            </td>
        </tr>

        <!-- Section Renderer -->
		<?php
		function render_section_title( $title ) {
			echo '
			<tr><td style="padding:30px 30px 10px;">
				<h2 style="color:#2E86DE;font-size:18px;font-weight:600;margin:0 0 10px 0;border-bottom:1px solid #eaeaea;padding-bottom:10px;">' . esc_html( $title ) . '</h2>
			</td></tr>';
		}

		function render_table_header( $columns ) {
			echo '<thead><tr>';
			foreach ( $columns as $col ) {
				echo '<th style="padding:12px;background:#f1f4f8;border:1px solid #e1e7ec;text-align:left;font-size:14px;color:#333;font-weight:600;">' . esc_html( $col ) . '</th>';
			}
			echo '</tr></thead>';
		}

		function render_table_cell( $text ) {
			echo '<td style="padding:10px;border:1px solid #eaeaea;background:#ffffff;font-size:13px;color:#555;">' . $text . '</td>';
		}

		?>

        <!-- Most Played Players -->
		<?php render_section_title( __( 'Most Played Players', 'radio-player' ) ); ?>
        <tr>
            <td style="padding:0 30px 30px;">
                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
					<?php render_table_header( [
						__( 'Player', 'radio-player' ),
						__( 'Unique Listeners', 'radio-player' ),
						__( 'Play Count', 'radio-player' ),
						__( 'Play Duration', 'radio-player' ),
					] ); ?>
                    <tbody>
					<?php foreach ( $players ?? [] as $player ) {

						$player_id = $player['player_id'];

						$player_title = sprintf(
							'<a href="%s/admin.php?page=radio-player&id=%s" style="color:#2E86DE;text-decoration:none;">%s</a>',
							admin_url(),
							intval( $player['player_id'] ),
							esc_html( $player['player_title'] )
						);

						?>
                        <tr>
							<?php
							render_table_cell( $player_title );
							render_table_cell( $player['total_users'] );
							render_table_cell( $player['total_plays'] );
							render_table_cell( radio_players_format_duration( $player['total_duration'] ) );
							?>
                        </tr>
					<?php } ?>
                    </tbody>
                </table>
            </td>
        </tr>

        <!-- Most Played Stations -->
		<?php render_section_title( __( 'Most Played Stations', 'radio-player' ) ); ?>
        <tr>
            <td style="padding:0 30px 30px;">
                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
					<?php render_table_header( [
						__( 'Station', 'radio-player' ),
						__( 'Player', 'radio-player' ),
						__( 'Unique Listeners', 'radio-player' ),
						__( 'Play Count', 'radio-player' ),
						__( 'Play Duration', 'radio-player' ),
					] ); ?>
                    <tbody>
					<?php foreach ( $stations ?? [] as $station ) {

						$station_title = sprintf(
							'<a href="%s/admin.php?page=radio-player&id=%s&station=%s" style="color:#2E86DE;text-decoration:none;">%s</a>',
							admin_url(),
							intval( $station['player_id'] ),
							intval( $station['station'] ),
							esc_html( $station['station_title'] )
						);

						?>
                        <tr>
							<?php
							render_table_cell( $station_title );
							render_table_cell( $station['player_title'] );
							render_table_cell( $station['total_users'] );
							render_table_cell( $station['total_plays'] );
							render_table_cell( radio_players_format_duration( $station['total_duration'] ) );
							?>
                        </tr>
					<?php } ?>
                    </tbody>
                </table>
            </td>
        </tr>

        <!-- Play Count by Date -->
		<?php render_section_title( __( 'Play Count by Date', 'radio-player' ) ); ?>
        <tr>
            <td style="padding:0 30px 30px;">
                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
					<?php render_table_header( [
						__( 'Date', 'radio-player' ),
						__( 'Total Plays', 'radio-player' ),
						__( 'Unique Listeners', 'radio-player' ),
					] ); ?>
                    <tbody>
					<?php
					$grouped_logs = [];
					foreach ( $logs ?? [] as $log ) {
						$date_only                    = date( 'Y-m-d', strtotime( $log['date'] ) );
						$grouped_logs[ $date_only ][] = $log;
					}
					foreach ( $grouped_logs as $date => $group ) {
						echo '<tr>';
						render_table_cell( $date );
						render_table_cell( count( $group ) );
						render_table_cell( count( array_unique( wp_list_pluck( $group, 'ip' ) ) ) );
						echo '</tr>';
					}
					?>
                    </tbody>
                </table>
            </td>
        </tr>

        <!-- Play Duration by Date -->
		<?php render_section_title( __( 'Play Duration by Date', 'radio-player' ) ); ?>
        <tr>
            <td style="padding:0 30px 40px;">
                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
					<?php render_table_header( [
						__( 'Date', 'radio-player' ),
						__( 'Total Duration', 'radio-player' ),
						__( 'Unique Listeners', 'radio-player' ),
					] ); ?>
                    <tbody>
					<?php
					foreach ( $grouped_logs as $date => $group ) {
						echo '<tr>';
						render_table_cell( $date );
						render_table_cell( radio_players_format_duration( array_sum( wp_list_pluck( $group, 'duration' ) ) ) );
						render_table_cell( count( array_unique( wp_list_pluck( $group, 'ip' ) ) ) );
						echo '</tr>';
					}
					?>
                    </tbody>
                </table>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background:#f5f6fa;padding:20px 30px;text-align:center;color:#888;font-size:12px;">
				<?php _e( 'This email was generated by Radio Player on', 'radio-player' ); ?>
                <a href="<?php echo esc_url( site_url() ); ?>"
                   style="color:#2E86DE;text-decoration:none;"><?php bloginfo( 'name' ); ?></a>.
            </td>
        </tr>

    </table>
</div>
