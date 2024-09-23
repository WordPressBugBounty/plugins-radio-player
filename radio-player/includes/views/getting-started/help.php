<?php

$faqs = [
	[
		'question' => __( 'Can I play HTTP stream on my HTTPS website?', 'radio-player' ),
		'answer'   => __( 'Browsers no longer accept mixed requests. That means you can\'t play an HTTP stream to an HTTPS
                    website. But, this plugin uses a proxy system to play most HTTP streams in your HTTPS website.', 'radio-player' ),
	],
	[
		'question' => __( 'Why is the current song title not displaying in the player?', 'radio-player' ),
		'answer'   => __( 'There could be several reasons why the current song title isn’t displaying on your player. One common reason is that the player is not receiving the stream metadata from the server. This can happen if the server doesn’t provide the metadata, or if the player is not configured to display it.
<br/>
<br/>
To troubleshoot this issue, you can try the following steps:
<ol>
<li>Check if the stream has metadata: If the metadata is not present, then it won’t be possible to display the current song title on the player.</li>
<li>Make sure the “Show Track Title” setting is enabled in the player controls settings.</li>
<li>Make sure <b>allow_url_fopen</b> is enabled on the server: If allow_url_fopen is disabled on the server, the player won’t be able to retrieve the metadata from the stream. You can contact your web host to enable this setting or modify the server configuration yourself if you have access.</li>
<li>If the stream title still not showing then try to enable the <strong>Metadata Proxy</strong> settings from the HTTP player settings tab in the plugin settings page.</li>
<li>If you’ve tried these steps and still can’t display the current song title on your player, please don’t hesitate to contact us for further assistance.</li>
</ol>
', 'radio-player' ),
	],
	[
		'question' => __('Can I add and display multiple radio stations in the same player?', 'radio-player'),
		'answer'   => __('Yes, you can add and display multiple radio stations in the same player. While you create a new player, you can add multiple radio stations with Title, Stream URL and Image from the stations tab. They will display as stations playlist in the player.', 'radio-player'),
	],
	[
		'question' => __('How can I display the sticky player?', 'radio-player'),
		'answer'   => __('To display the sticky player, you need to select the Player that you want to display as a sticky player from the <code>Radio Player > Sticky Player Settings</code>.', 'radio-player'),
	],
	[
		'question' => __('How can I display the sticky player only on specific pages?', 'radio-player'),
		'answer'   => __('By default, the sticky player will be displayed on all pages. But, You can also show the sticky player only on specific pages by excluding the pages from the <code>Radio Player > Settings > Sticky Player Settings</code>.', 'radio-player'),
	],
	[
		'question' => __('How can I display the popup player?', 'radio-player'),
		'answer'   => __('There is a popup icon option for the player. You can show/ hide the player\'s popup control, and when users click on it, The player will open within a new popup window.', 'radio-player'),
	],
	[
		'question' => __('Can I embed a radio player on another website?', 'radio-player'),
		'answer'   => __('Yes, you can embed a radio player on another website. You can find the embed code on the player listing page. Just click on the Embed button and copy the embed code. Then paste the embed code on any website.', 'radio-player'),
	],
	[
		'question' => __('How can I view the play statistics for my radio player?', 'radio-player'),
		'answer'   => __('To view the play statistics for your radio player, navigate to <code>Radio Player > Statistics</code>. Here, you can see the number of plays, the total play duration, and the top played stations.', 'radio-player'),
	],
	[
		'question' => __('How can I customize the appearance of the radio player?', 'radio-player'),
		'answer'   => __('You can customize the appearance of the radio player using custom CSS. Navigate to <code>Radio Player > Settings > Custom CSS</code> to add your CSS code. You can also choose from multiple player skins and customize the popup player size, header, and footer content, and color scheme from the settings page.', 'radio-player'),
	],
	[
		'question' => __('Is the radio player compatible with mobile devices?', 'radio-player'),
		'answer'   => __('Yes, the radio player is compatible with mobile devices and supports mobile media notifications. The player will automatically adjust its size and appearance based on the device\'s screen size.', 'radio-player'),
	],
];

?>

<div id="help" class="getting-started-content">

    <div class="content-heading">
        <h2><?php esc_html_e( 'Frequently Asked Questions', 'radio-player' ); ?></h2>
    </div>

    <section class="section-faq">
		<?php foreach ( $faqs as $faq ) : ?>
            <div class="faq-item">
                <div class="faq-header">
                    <i class="dashicons dashicons-arrow-down-alt2"></i>
                    <h3><?php echo $faq['question']; ?></h3>
                </div>

                <div class="faq-body">
                    <p><?php echo $faq['answer']; ?></p>
                </div>
            </div>
		<?php endforeach; ?>
    </section>

    <div class="content-heading">
        <h2><?php esc_html_e( 'Need Help?', 'radio-player' ); ?></h2>
        <p><?php esc_html_e( 'Read our knowledge base documentation or you can contact us directly.', 'radio-player' ); ?></p>
    </div>

    <div class="section-wrap">
        <section class="section-documentation section-half">
            <div class="col-image">
                <img src="<?php echo RADIO_PLAYER_ASSETS . '/images/getting-started/documentation.png' ?>"
                     alt="<?php esc_attr_e( 'Documentation', 'radio-player' ); ?>">
            </div>
            <div class="col-description">
                <h2><?php _e( 'Documentation', 'radio-player' ) ?></h2>
                <p>
					<?php esc_html_e( 'Check out our detailed online documentation and video tutorials to find out more about what you can
                    do.', 'radio-player' ); ?>
                </p>
                <a class="radio-player-btn" href="https://softlabbd.com/radio-player"
                   target="_blank"><?php esc_html_e( 'Documentation', 'radio-player' ); ?></a>
            </div>
        </section>

        <section class="section-contact section-half">
            <div class="col-image">
                <img src="<?php echo RADIO_PLAYER_ASSETS . '/images/getting-started/contact.png' ?>"
                     alt="<?php esc_attr_e( 'Contact', 'radio-player' ); ?>">
            </div>
            <div class="col-description">
                <h2><?php esc_html_e( 'Support', 'radio-player' ); ?></h2>
                <p><?php esc_html_e( 'We have dedicated support team to provide you fast, friendly & top-notch customer support.', 'radio-player' ); ?></p>
                <a class="radio-player-btn" href="https://softlabbd.com/support" target="_blank">
					<?php esc_html_e( 'Get Support', 'radio-player' ); ?>
                </a>
            </div>
        </section>
    </div>

</div>

<script>
    jQuery(document).ready(function ($) {
        $('.faq-item .faq-header').on('click', function () {
            $(this).parent().toggleClass('active');
        });
    });
</script>