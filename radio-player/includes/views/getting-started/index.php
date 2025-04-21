<?php

defined( 'ABSPATH' ) || exit;
?>

<div class="radio-player-getting-started">
    <div class="getting-started-header">
        <div class="header-logo">
            <img src="<?php 
echo RADIO_PLAYER_ASSETS . '/images/radio-player-logo.png';
?>">
            <span><?php 
esc_html_e( 'Radio Player', 'radio-player' );
?></span>
        </div>
        <p><?php 
esc_html_e( 'Live Shoutcast, Icecast and Audio Stream Player for WordPress', 'radio-player' );
?></p>
        <h2 class="header-title"><?php 
esc_html_e( 'Getting Started', 'radio-player' );
?></h2>
    </div>

    <div class="getting-started-main">

        <div class="getting-started-menu">
            <div class="menu-item active" data-target="introduction">
                <img src="<?php 
echo RADIO_PLAYER_ASSETS;
?>/images/getting-started/header/introduction.svg"/>
                <span><?php 
esc_html_e( 'Introduction', 'radio-player' );
?></span>
            </div>

            <!-- Basic Usage -->
            <div class="menu-item" data-target="basic-usage">
                <img src="<?php 
echo RADIO_PLAYER_ASSETS;
?>/images/getting-started/header/basic-usage.svg"/>

                <span><?php 
esc_html_e( 'Basic Usage', 'radio-player' );
?></span>
            </div>

            <!-- Proxy Player Add-on -->
            <div class="menu-item" data-target="http-player-addon">
                <img src="<?php 
echo RADIO_PLAYER_ASSETS;
?>/images/getting-started/header/proxy-player.svg"/>


                <span><?php 
esc_html_e( 'HTTP Stream Player', 'radio-player' );
?>
            </div>

            <!-- Ads Player Add-on -->
            <div class="menu-item" data-target="ads-player-addon">

                <img src="<?php 
echo RADIO_PLAYER_ASSETS;
?>/images/getting-started/header/ads-player.svg"/>


                <span><?php 
esc_html_e( 'Ads Player', 'radio-player' );
?>
            </div>

            <!-- Help -->
            <div class="menu-item" data-target="help">
                <img src="<?php 
echo RADIO_PLAYER_ASSETS;
?>/images/getting-started/header/help.svg"/>

                <span><?php 
esc_html_e( 'Help', 'radio-player' );
?></span>
            </div>

            <!-- Changelog -->
            <div class="menu-item" data-target="what-new">
                <img src="<?php 
echo RADIO_PLAYER_ASSETS;
?>/images/getting-started/header/changelog.svg"/>

                <span><?php 
esc_html_e( 'Changelog', 'radio-player' );
?></span>
            </div>

            <!-- GET PRO -->
			<?php 
?>
                <div class="menu-item" data-target="get-pro">
                    <img src="<?php 
echo RADIO_PLAYER_ASSETS;
?>/images/getting-started/header/get-pro.svg"/>

                    <span><?php 
esc_html_e( 'Get Pro', 'radio-player' );
?></span>
                </div>
			<?php 
?>

        </div>

		<?php 
include_once RADIO_PLAYER_INCLUDES . '/views/getting-started/introduction.php';
?>
		<?php 
include_once RADIO_PLAYER_INCLUDES . '/views/getting-started/what-new.php';
?>
		<?php 
include_once RADIO_PLAYER_INCLUDES . '/views/getting-started/basic-usage.php';
?>
		<?php 
include_once RADIO_PLAYER_INCLUDES . '/views/getting-started/proxy-player-addon.php';
?>
		<?php 
include_once RADIO_PLAYER_INCLUDES . '/views/getting-started/ads-player-addon.php';
?>
		<?php 
include_once RADIO_PLAYER_INCLUDES . '/views/getting-started/help.php';
?>
		<?php 
include_once RADIO_PLAYER_INCLUDES . '/views/getting-started/get-pro.php';
?>

    </div>

</div>

<script>
    jQuery(document).on('ready', function () {
        jQuery('.radio-player-getting-started .menu-item').on('click', function () {
            const target = jQuery(this).data('target');

            jQuery('.menu-item').removeClass('active');
            jQuery('.getting-started-content').removeClass('active');

            jQuery(this).addClass('active');
            jQuery('#' + target).addClass('active');
        });
    });
</script>
