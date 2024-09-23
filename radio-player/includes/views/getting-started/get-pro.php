<?php

$features = [
	[
		'title' => __( 'Shortcode Player', 'radio-player' ),
		'pro'   => 0,
	],
	[
		'title' => __( 'MP3 + AAC + M3U8 Compatibility', 'radio-player' ),
		'pro'   => 0,
	],
	[
		'title' => __( 'Current Song Title', 'radio-player' ),
		'pro'   => 0,
	],
	[
		'title' => __( 'Add Multiple Players', 'radio-player' ),
		'pro'   => 0,
	],
	[
		'title' => __( 'Player Duplicator', 'radio-player' ),
		'pro'   => 0,
	],
	[
		'title' => __( 'Live Player Editing Preview', 'radio-player' ),
		'pro'   => 0,
	],
	[
		'title' => __( 'Multiple Player Instance', 'radio-player' ),
		'pro'   => 0,
	],
	[
		'title' => __( 'Mobile Media Notification', 'radio-player' ),
		'pro'   => 0,
	],
	[
		'title' => __( 'Gutenberg Editor Block', 'radio-player' ),
		'pro'   => 0,
	],
	[
		'title' => __( 'Elementor Page Builder Widget', 'radio-player' ),
		'pro'   => 0,
	],
	[
		'title' => __( 'Custom CSS', 'radio-player' ),
		'pro'   => 0,
	],
	[
		'title' => __( 'Full-width Sticky Player', 'radio-player' ),
		'pro'   => true,
	],
	[
		'title' => __( 'Sticky Player on Specific Pages', 'radio-player' ),
		'pro'   => true,
	],
	[
		'title' => __( 'Multiple Stations in a Player', 'radio-player' ),
		'pro'   => true,
	],
	[
		'title' => __( 'Multiple Player Skins', 'radio-player' ),
		'pro'   => true,
	],
	[
		'title' => __( 'Stations Playlist', 'radio-player' ),
		'pro'   => true,
	],
	[
		'title' => __( 'Recent Play History', 'radio-player' ),
		'pro'   => true,
	],
	[
		'title' => __( 'Artist + Artwork Display', 'radio-player' ),
		'pro'   => true,
	],
	[
		'title' => __( 'Play Statistics', 'radio-player' ),
		'pro'   => true,
	],
	[
		'title' => __( 'Popup Player', 'radio-player' ),
		'pro'   => true,
	],
	[
		'title' => __( 'Player Embed', 'radio-player' ),
		'pro'   => true,
	],
	[
		'title' => __( 'Size Customizations', 'radio-player' ),
		'pro'   => true,
	],
	[
		'title' => __( 'Color Customizations', 'radio-player' ),
		'pro'   => true,
	],
];

?>

<div id="get-pro" class="getting-started-content content-get-pro">
    <div class="content-heading">
        <h2><?php _e( 'Unlock the full power of the Radio Player', 'radio-player' ); ?></h2>
        <p><?php _e( 'Upgrade to the Pro version to get more powerful features and premium support.', 'radio-player' ); ?></p>
    </div>

    <div class="content-heading free-vs-pro">
        <h2><span><?php esc_html_e('Free', 'radio-player'); ?></span> vs <span><?php esc_html_e('Pro', 'radio-player'); ?></span></h2>
    </div>

    <div class="features-list">
        <div class="list-header">
            <div class="feature-title"><?php esc_html_e('Feature List', 'radio-player'); ?></div>
            <div class="feature-free"><?php esc_html_e('Free', 'radio-player'); ?></div>
            <div class="feature-pro"><?php esc_html_e('Pro', 'radio-player'); ?></div>
        </div>

		<?php foreach ( $features as $feature ) : ?>
            <div class="feature">
                <div class="feature-title"><?php echo $feature['title']; ?></div>
                <div class="feature-free">
					<?php if ( $feature['pro'] ) : ?>
                        <i class="dashicons dashicons-no-alt"></i>
					<?php else : ?>
                        <i class="dashicons dashicons-saved"></i>
					<?php endif; ?>
                </div>
                <div class="feature-pro">
                    <i class="dashicons dashicons-saved"></i>
                </div>
            </div>
		<?php endforeach; ?>

    </div>

    <div class="get-pro-cta">
        <div class="cta-content">
            <h2><?php esc_html_e('Don\'t waste time, get the PRO version now!', 'radio-player'); ?></h2>
            <p><?php esc_html_e('Upgrade to the PRO version of the plugin and unlock all the amazing Google Drive Integration features for your website.', 'radio-player'); ?></p>
        </div>

        <div class="cta-btn">
            <a href="<?php echo rp_fs()->get_upgrade_url(); ?>" class="radio-player-btn"><?php esc_html_e('Upgrade Now', 'radio-player'); ?></a>
        </div>

    </div>

    <div class="demo-cta">
        <div class="cta-content">
            <h2><?php esc_html_e('Want to try live demo, before purchase?', 'radio-player'); ?></h2>
            <p><?php esc_html_e('You can try our instant ready-made demo. The demo allows you to experiment with all the functionality of
                the plugins on both Front-End and Back-End. Feel free to explore the possibilities and limits of our
                plugins to see if it fits your requirements!', 'radio-player'); ?></p>
        </div>

        <div class="cta-btn">
            <a href="https://demo.softlabbd.com/?product=radio-player" target="_blank" class="radio-player-btn"><?php esc_html_e('Try Live Demo', 'radio-player'); ?></a>
        </div>

    </div>

</div>