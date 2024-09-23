<div id="basic-usage" class="getting-started-content">

    <!-- Add New Player -->
    <section class="section-add-new-player">
        <div class="col-description">
            <h2><?php esc_html_e( 'Add New Player', 'radio-player' ); ?></h2>
            <p>
				<?php printf( __( 'To play a radio station, you need to add a new player. You can add a new player from the %s Radio Player %s page.', 'radio-player' ), '<a href="' . admin_url( 'admin.php?page=radio-player' ) . '">', '</a>' ); ?>
            </p>
            <p>
				<?php esc_html_e( 'From the Stations tab, you need to add the stations that you want to play in the player.
                You have to insert the name, stream URL, and logo image for the station.
                You can add multiple stations in the same.', 'radio-player' ); ?>
            </p>
            <p>
				<?php esc_html_e( 'Form the Player Skins tab, you can select the player skin from the available 10+ skins with different
                layouts and styles.', 'radio-player' ); ?>
            </p>
            <p>
				<?php esc_html_e( 'From the Controls tab, you can show or hide the player controls like popup icon, playlist icon, volume
                icon, live/ offline player status, etc.', 'radio-player' ); ?>
            </p>
            <p>
				<?php esc_html_e( 'From the appearance tab, you can customize the player appearance like player background color, player
                text color, player width, border radius, box shadow, etc.', 'radio-player' ); ?>
            </p>
            <p>
				<?php esc_html_e( 'While you are editing the player, you can see the player preview in realtime in the preview section.', 'radio-player' ); ?>
            </p>
            <p>
				<?php esc_html_e( 'Once you are done with the player settings, you can save the player and use it anywhere on your website.', 'radio-player' ); ?>
            </p>
        </div>

        <div class="col-image">
            <iframe
                    src="https://www.youtube.com/embed/Kwa4Xcd_N_0?rel=0"
                    title="YouTube video player" frameBorder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowFullScreen></iframe>
        </div>
    </section>

    <!-- Display Radio Player -->
    <section class="section-display-player">
        <div class="col-description">
            <h2><?php esc_html_e( 'Display Radio Player', 'radio-player' ); ?></h2>
            <p>
				<?php esc_html_e( 'After adding a new player, you can display the player in your website in various ways.', 'radio-player' ); ?>
            </p>

            <p>
				<?php _e( 'You can display the player anywhere using the <code>[radio_player id="player_id"]</code>
                shortcode.', 'radio-player' ); ?>
            </p>
            <p>
				<?php _e( 'You have to use a valid player id in the shortcode id attribute to display the player.
                You will get the player id from the <code>Radio Player > All Players</code> page.', 'radio-player' ); ?>
            </p>

            <p>
				<?php esc_html_e( 'You can also display the Radio Player in any page or post by using the Radio Player Gutenberg block and
                Elementor widget.', 'radio-player' ); ?>
            </p>

            <p>
				<?php esc_html_e( 'For displaying the Radio Player using the Gutenberg block, you need to search and insert the Radio
                Player block in the page or post.
                In the Radio Player block, you have to select the player from the player list dropdown.', 'radio-player' ); ?>
            </p>

            <p>
				<?php esc_html_e( 'For displaying the Radio Player using the Elementor widget, you need to search and insert the Radio
                Player widget in the page or post.
                In the Radio Player widget, you have to select the player from the player list dropdown.', 'radio-player' ); ?>
            </p>

        </div>
        <div class="col-image">
            <iframe
                    src="https://www.youtube.com/embed/NTQmmAyIKeg?rel=0"
                    title="YouTube video player" frameBorder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowFullScreen></iframe>
        </div>
    </section>

    <!-- Display Sticky Player -->
    <section class="section-display-sticky-player">
        <div class="col-description">
            <h2><?php esc_html_e( 'Display Sticky Player', 'radio-player' ); ?></h2>
            <p>
				<?php esc_html_e( 'This plugin provides a sticky player feature with multiple styles (Fullwidth, Mini-Fullwidth and
                Floating) that will be displayed at the bottom or top of the website in
                the all pages.', 'radio-player' ); ?>
            </p>
            <p>
				<?php _e( 'For displaying the sticky player, you need to select the Player that you want to display as
                sticky player from the <code>Radio Player > Settings > Sticky Player Settings</code>.', 'radio-player' ); ?>
            </p>

            <p>
				<?php esc_html_e( 'You can also display the sticky player only on specific pages. From the Exclude Pages settings, you
                can select the pages where you don\'t want to display the sticky player.', 'radio-player' ); ?>
            </p>

        </div>
        <div class="col-image">
            <iframe
                    src="https://www.youtube.com/embed/8-kY840d6fQ?rel=0"
                    frameBorder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowFullScreen></iframe>
        </div>
    </section>

    <!-- Display Radio Player at Specific Times -->
    <section class="section-schedule">
        <div class="col-description">
            <h2><?php esc_html_e( 'Display Player at Specific Times', 'radio-player' ); ?></h2>
            <p>
				<?php esc_html_e( 'If your station isn\'t live 24/7 or broadcasts only at set times, scheduling your player to display during these periods can greatly benefit both you and your listeners.', 'radio-player' ); ?>
            </p>

            <p>
				<?php _e( 'Radio Player offers you a variety of scheduling options to match your player\'s unique requirements.', 'radio-player' ); ?>
                <br>
				<?php _e( 'Here\'s a quick rundown of the modes available:', 'radio-player' ); ?>
            </p>

            <ul>
                <li>
                    <strong><?php esc_html_e( 'Always', 'radio-player' ); ?></strong> - <?php esc_html_e( 'The player will always be displayed.', 'radio-player' ); ?>
                </li>
                <li>
                    <strong><?php esc_html_e( 'Daily', 'radio-player' ); ?></strong> - <?php esc_html_e( 'Use the "Daily" mode to set specific times of a day to show/ hide the player.', 'radio-player' ); ?>
                </li>
                <li>
                    <strong><?php esc_html_e( 'Weekly', 'radio-player' ); ?></strong> - <?php esc_html_e( 'Use the "Weekly" mode to set specific days and times of the days to show/ hide the player.', 'radio-player' ); ?>
                </li>
                <li>
                    <strong><?php esc_html_e( 'Monthly', 'radio-player' ); ?></strong> - <?php esc_html_e( 'Use the "Monthly" mode to set specific dates and times of the dates to show/ hide the player.', 'radio-player' ); ?>
                </li>
            </ul>

            <p>
                <?php esc_html_e( 'To set the schedule for any player, follow the steps below:', 'radio-player' ); ?>
            </p>

            <ol>
                <li><strong><?php esc_html_e('Select Player', 'radio-player'); ?></strong> - <?php esc_html_e('Next, select the player for which you want to set the schedule.', 'radio-player'); ?></li>
                <li><strong><?php esc_html_e('Set Schedule', 'radio-player'); ?></strong> - <?php esc_html_e('Now, click on the "Schedules" tab and set your preferred schedule type from daily, weekly, monthly or always. from the "Schedule Type" dropdown.', 'radio-player'); ?></li>
                <li><strong><?php esc_html_e('Set Times, Days or Dates', 'radio-player'); ?></strong> - <?php esc_html_e('After selecting the schedule type, set the times, days or dates for which you want to display the player.', 'radio-player'); ?></li>
                <li><strong><?php esc_html_e('Save Changes', 'radio-player'); ?></strong> - <?php esc_html_e('Finally, click on the "Save Changes" button to save the schedule.', 'radio-player'); ?></li>
            </ol>



        </div>
        <div class="col-image">
            <iframe src="https://www.youtube.com/embed/pt-FegxJGZo?rel=0" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
        </div>
    </section>


</div>