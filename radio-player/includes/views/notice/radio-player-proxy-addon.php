<style>
    .update-php .wrap {
        max-width: calc(100% - 20px) !important;
    }
</style>

<div class="notice-image">
    <img src="<?php 
echo RADIO_PLAYER_ASSETS . '/images/radio-player-proxy-icon.png';
?>">
</div>

<div class="notice-main">

    <div class="notice-text">
        <h3 class="notice-title">
			<?php 
_e( 'Radio Player Proxy Add-on', 'radio-player' );
?>
        </h3>
        <p>
			<?php 
_e( 'Radio Player Proxy Add-on allows seamless playback of HTTP radio streams on HTTPS websites.', 'radio-player' );
?>
            <br>
			<?php 
_e( 'Additionally, it can also fix the metadata display including current track title, artist, artwork, and recent play history in the player.', 'radio-player' );
?>
        </p>
        <a href="#" class="hide_notice"><?php 
_e( 'Never show this', 'radio-player' );
?></a>
        <a href="<?php 
echo admin_url();
?>/plugin-install.php?fs_allow_updater_and_dialog=true&tab=plugin-information&parent_plugin_id=8684&plugin=radio-player-proxy&"><?php 
_e( 'More Details', 'radio-player' );
?></a>
        <a href="<?php 
echo esc_url( rp_fs()->get_addons_url() );
?>"><?php 
_e( 'Get Now', 'radio-player' );
?></a>
    </div>

	<?php 
?>

</div>

<script>
    ;(function ($) {
        $(document).ready(function () {
            $('.hide_notice').on('click', function (e) {
                e.preventDefault();
                wp.ajax.post('rp_hide_radio_player_proxy_addon_notice');
                $('.radio-player-proxy-addon-notice').slideUp();
            });
        });
    })(jQuery);
</script>