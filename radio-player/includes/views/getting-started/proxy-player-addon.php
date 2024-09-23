<div id="http-player-addon" class="getting-started-content">

    <section class="section-introduction section-full">
        <div class="col-description">
            <h2><?php esc_html_e( 'Radio Player Proxy Add-on - Quick Overview', 'radio-player' ); ?></h2>

            <p>
				<?php esc_html_e( 'Recent updates in Google Chrome have introduced stringent rules against mixed content.
As a result, if a stream link isn\'t SSL-encrypted but your website is, it won\'t play on Chrome.
Notably, many browsers are following Chrome\'s lead. Therefore, it\'s crucial to ensure your stream links are SSL-secured.
', 'radio-player' ); ?>
            </p>

            <p>
				<?php esc_html_e( 'Radio Player Proxy Add-on facilitates the playback of HTTP (non-SSL) radio streams on HTTPS-enabled websites. Serving as a bridge, it retrieves the radio stream and delivers it to the player as an HTTPS stream.', 'radio-player' ); ?>
            </p>
            <p>
				<?php esc_html_e( 'The add-n use an external VPS proxy server that allow you to play most of the HTTP streams in your HTTPS website.', 'radio-player' ); ?>
            </p>

            <p>
				<?php esc_html_e( 'Additionally, if your website server struggles to retrieve stream data, the plugin can display the current song title for you.', 'radio-player' ); ?>
            </p>

        </div>

        <div class="col-image">
            <iframe
                    src="https://www.youtube.com/embed/M3M7ssz8URc?rel=0"
                    frameBorder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowFullScreen>
            </iframe>
        </div>
    </section>

    <div class="content-heading">
        <h2><?php esc_html_e( 'How to Play HTTP streams on HTTPS website', 'radio-player' ); ?></h2>
    </div>

    <section class="section-radio-player-ads">
        <div class="col-description">

            <p><?php esc_html_e( 'To play HTTP streams on an HTTPS (SSL-enabled) website, follow these steps:', 'radio-player' ); ?></p>

            <ul>
                <li>
					<?php printf( __( 'Navigate to %s Radio Player > Settings %s.', 'radio-player' ), '<strong>', '</strong>' ) ?>
                </li>

                <li>
					<?php printf( __( 'In the %s Proxy Settings %s tab, modify the following settings:', 'radio-player' ), '<strong>', '</strong>' ) ?>
                    <ul>
                        <li>
							<?php printf( __( '%s Enable HTTP Proxy: %s Activate this setting to play HTTP streams directly on your server by enabling its proxy system. Utilizing the proxy on your own server eliminates reliance on third-party servers, making your radio streams faster and more flexible.', 'radio-player' ), '<strong>', '</strong>' ) ?>
                        </li>
                        <li>
							<?php printf( __( '%s Proxy URL: %s If the player still doesn\'t work after enabling the HTTP player, copy the proxy link and paste it into the Proxy URL input box.', 'radio-player' ), '<strong>', '</strong>' ) ?>
                        </li>
                        <li>
							<?php printf( __( '%s Save an Check: %s Save the settings and check the players.', 'radio-player' ), '<strong>', '</strong>' ) ?>
                        </li>
                    </ul>
                </li>
            </ul>

            <p></p>
            <p></p>


            <p>
                <strong><?php esc_html_e( 'Note: ', 'radio-player' ); ?></strong>
				<?php esc_html_e( 'The proxy system might not support certain HTTP streams, such as .m3u8.', 'radio-player' ); ?>
            </p>

            <p>
				<?php esc_html_e( 'If this occurs, utilize the plugin\'s Popup player feature for these streams. This player operates in HTTP mode, but to use it, you must disable the HTTP to HTTPS redirection on your website.', 'radio-player' ); ?>

            </p>
            <p>
				<?php esc_html_e( 'HTTP to HTTPS redirection can be set up in multiple ways: through the .htaccess file, SSL WordPress plugins, Cloudflare, or cPanel server settings. Ensure it\'s disabled in all relevant areas.', 'radio-player' ); ?>
            </p>

        </div>
    </section>

    <div class="content-heading">
        <h2><?php esc_html_e( 'How to Fix Metadata Display (current track title, artist, artwork)', 'radio-player' ); ?></h2>
    </div>
    <section class="section-radio-player-ads">
        <div class="col-description">

            <p><?php esc_html_e( 'Occasionally, due to server limitations, the stream data including current song title, artist name and artwork image and recent play history may not appear in the player.', 'radio-player' ); ?></p>
            <p><?php esc_html_e( 'To resolve this and display the stream metadata in the player, follow the steps below', 'radio-player' ); ?></p>


            <ul>
                <li>
					<?php printf( __( 'Navigate to %s Radio Player > Settings %s.', 'radio-player' ), '<strong>', '</strong>' ) ?>
                </li>

                <li>
					<?php printf( __( 'In the %1$s Proxy Settings %2$s tab, enable the %1$s Metadata Proxy %2$s option. This will facilitate fetching the stream metadata through the proxy server."', 'radio-player' ), '<strong>', '</strong>' ) ?>
                </li>
                <li>
					<?php printf( __( '%s Save an Check: %s Save the settings and check the players for the stream metadata.', 'radio-player' ), '<strong>', '</strong>' ) ?>
                </li>
            </ul>

            <p>
                <strong><?php esc_html_e( 'Note: ', 'radio-player' ); ?></strong>
		        <?php esc_html_e( 'Not all streams may have metadata for display.', 'radio-player' ); ?>
            </p>

        </div>
    </section>


</div>