<?php

$features = [
	'compatibility' => [
		'title'       => __( 'MP3 + AAC + M3U8 Compatible', 'radio-player' ),
		'description' => __( 'Radio Player is compatible with MP3, AAC, and M3U8 streams. It also supports HLS streams.', 'radio-player' ),
	],

	'shortcode-player' => [
		'title'       => __( 'Shortcode Player', 'radio-player' ),
		'description' => __( 'Radio Player comes with a shortcode player that you can use to display your player anywhere on your site.', 'radio-player' ),
	],

	'current-song-title' => [
		'title'       => __( 'Stream Data Display', 'radio-player' ),
		'description' => __( 'Radio Player can grab and display the stream metadata including current track title, artist and artwork, and recent play history on the player.', 'radio-player' ),
	],

	'player-duplicator' => [
		'title'       => __( 'Player Duplicator', 'radio-player' ),
		'description' => __( 'Radio Player comes with a player duplicator that allows you to duplicate your previously created players with all the settings.', 'radio-player' ),
	],

	'mobile-media-notification' => [
		'title'       => __( 'Mobile Media Notification', 'radio-player' ),
		'description' => __( 'Radio Player shows a media notification on mobile devices, allowing users to easily play or pause from the notification bar.', 'radio-player' ),
	],

	'add-multiple-players' => [
		'title'       => __( 'Add Multiple Players', 'radio-player' ),
		'description' => __( 'Radio Player allows you to create upto 10 players in the free version and and can create unlimited players in the PRO version.', 'radio-player' ),
	],

	'multiple-instances' => [
		'title'       => __( 'Multiple Instances', 'radio-player' ),
		'description' => __( 'Radio Player allows you to display multiple players on the same page.', 'radio-player' ),
	],

	'custom-css' => [
		'title'       => __( 'Custom CSS', 'radio-player' ),
		'description' => __( 'Radio Player provides a Custom CSS feature to customize the player looks and styles.', 'radio-player' ),
	],

	'color-customizations' => [
		'title'       => __( 'Color Customizations', 'radio-player' ),
		'description' => __( 'Radio Player allows you to customize the player text, button, background, and box-shadow colors.', 'radio-player' ),
	],
	'play-statistics'      => [
		'title'       => __( 'Play Statistics', 'radio-player' ),
		'description' => __( 'Radio Player allows you to track the play statistics of your players. You can see the total number of play count, total number of listeners, and the most played players.', 'radio-player' ),
	],
	'gutenberg-block'      => [
		'title'       => __( 'Gutenberg Block', 'radio-player' ),
		'description' => __( 'Radio Player comes with a Gutenberg block that you can use to display your player on any page or post.', 'radio-player' ),
	],
	'elementor-widget'     => [
		'title'       => __( 'Elementor Widget', 'radio-player' ),
		'description' => __( 'Radio Player comes with an Elementor widget that you can use to display your player on any page or post.', 'radio-player' ),
	],

];

?>

<div id="introduction" class="getting-started-content active">

    <section class="section-introduction section-full">
        <div class="col-description">
            <h2><?php esc_html_e( 'Radio Player Quick Overview', 'radio-player' ); ?></h2>

            <p>
				<?php esc_html_e( 'Radio Player is a user-friendly and easily customizable web radio player tailored for WordPress websites. It effortlessly connects to live MP3, Shoutcast, IceCast, and various other audio streams, providing a smooth listening experience for your visitors.', 'radio-player' ); ?>
            </p>

            <p>
				<?php esc_html_e( 'Incorporate the player into your site using simple options like shortcodes, Gutenberg blocks, Elementor widgets, sticky players, or popup players. With Radio Player, you can effortlessly enhance your WordPress website\'s appeal to users seeking an enjoyable web radio experience.', 'radio-player' ); ?>
            </p>
        </div>

        <div class="col-image">
            <iframe
                    src="https://www.youtube.com/embed/60puFspgnK8?rel=0"
                    title="YouTube video player" frameBorder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowFullScreen></iframe>
        </div>
    </section>

    <div class="content-heading">
        <h2><?php esc_html_e( 'Never miss a valuable features', 'radio-player' ); ?></h2>
        <p><?php esc_html_e( 'Let\'s explore the powerful features of the plugin', 'radio-player' ); ?></p>
    </div>

    <div class="section-wrap">
        <section class="section-fullwidth-player section-half">
            <div class="col-description">

                <h2><?php esc_html_e( 'Sticky Player', 'radio-player' ); ?></h2>
                <p>
				    <?php esc_html_e( 'Radio Player provides a Sticky Player feature that allows you to display the player on the
                    bottom of the screen. You can choose to display the Sticky Player on all pages or specific pages.', 'radio-player' ); ?>
                </p>
            </div>

            <div class="col-image">
                <img src="<?php echo RADIO_PLAYER_URL . '/assets/images/getting-started/fullwidth-player.png'; ?>">
            </div>
        </section>

        <section class="section-http-player section-half">
            <div class="col-description">
                <h2><?php esc_html_e( 'Player Display Schedule', 'radio-player' ); ?></h2>

                <p>
		            <?php esc_html_e( 'You can schedule the player visibility by setting the start date and end date. The player will be displayed on your website during the scheduled time.', 'radio-player' ); ?>
                </p>
            </div>

            <div class="col-image">
                <img src="<?php echo RADIO_PLAYER_URL . '/assets/images/getting-started/schedule.png'; ?>"/>
            </div>

        </section>


    </div>

    <!--  Multiple Player Skins -->
    <div class="section-wrap">
        <section class="section-multiple-skins section-half">
            <div class="col-description">
                <h2><?php esc_html_e( 'Multiple Player Skins', 'radio-player' ); ?></h2>

                <p>
					<?php esc_html_e( 'Radio Player provides 10+ player skins with different layouts and styles to choose from. You can choose any player skin from the skins library and display it anywhere on your website using the shortcode.', 'radio-player' ); ?>
                </p>
            </div>

            <div class="col-image">
                <img src="<?php echo RADIO_PLAYER_URL . '/assets/images/getting-started/multiple-skins.png'; ?>"/>
            </div>
        </section>

        <section class="section-multiple-stations section-half">
            <div class="col-description">
                <h2><?php esc_html_e( 'Multiple Stations Playlist', 'radio-player' ); ?></h2>
                <p>
					<?php esc_html_e( 'You can add and display multiple radio stations in the same player. Users can play the stations by using the next/ previous button in the player.', 'radio-player' ); ?>
                </p>
            </div>
            <div class="col-image">
                <img src="<?php echo RADIO_PLAYER_URL . '/assets/images/getting-started/multiple-stations.png'; ?>">
            </div>
        </section>
    </div>

    <!-- Popup Player -->
    <div class="section-wrap">
        <section class="section-popup-player section-half">
            <div class="col-description">
                <h2><?php esc_html_e( 'Popup Player', 'radio-player' ); ?></h2>
                <p>
					<?php esc_html_e( 'Radio Player provides a Popup Player feature that allows you to display the player in a popup window. You can choose to display the Popup Player on all pages or specific pages.', 'radio-player' ); ?>
                </p>
            </div>

            <div class="col-image">
                <img src="<?php echo RADIO_PLAYER_URL . '/assets/images/getting-started/popup-player.png'; ?>">
            </div>
        </section>

        <section class="section-embed-code section-half">
            <div class="col-description">
                <h2><?php esc_html_e( 'Player Embed Code', 'radio-player' ); ?></h2>

                <p>
					<?php esc_html_e( 'You can embed the player anywhere on your website using the embed code. You can also customize the player appearance with the embed code.', 'radio-player' ); ?>
                </p>
            </div>

            <div class="col-image">
                <img src="<?php echo RADIO_PLAYER_URL . '/assets/images/getting-started/embed-code.png'; ?>"/>
            </div>
        </section>
    </div>

    <!-- Realtime Editing Preview -->
    <section class="section-editing-preview section-full">
        <div class="col-description">
            <h2><?php esc_html_e( 'Realtime Player Editing Preview', 'radio-player' ); ?></h2>

            <p>
				<?php esc_html_e( 'You can customize the player appearance with a real-time preview. You can change the player colors, background color, background image, width, border radius, box shadow, and more.', 'radio-player' ); ?>
            </p>
        </div>

        <div class="col-image">
            <img src="<?php echo RADIO_PLAYER_URL . '/assets/images/getting-started/realtime-preview.gif'; ?>"/>
        </div>
    </section>
    

    <div class="content-heading">
        <h2><?php esc_html_e( 'More powerful features', 'radio-player' ); ?></h2>
        <p><?php esc_html_e( 'More extra valuable features to power up your website readability.', 'radio-player' ); ?></p>
    </div>

    <section class="integrations">
		<?php foreach ( $features as $key => $feature ) { ?>
            <div class="integration">
                <div class="integration-logo">
                    <img src="<?php echo RADIO_PLAYER_ASSETS . '/images/getting-started/' . $key . '.png'; ?>">
                </div>
                <h3 class="integration-title"><?php echo $feature['title'] ?></h3>
                <p><?php echo $feature['description']; ?></p>
            </div>
		<?php } ?>
    </section>

</div>