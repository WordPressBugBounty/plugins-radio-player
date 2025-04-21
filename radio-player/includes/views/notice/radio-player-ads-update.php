<style>
    .update-php .wrap {
        max-width: calc(100% - 20px) !important;
    }
</style>

<div class="notice-image">
    <img src="<?php echo RADIO_PLAYER_ASSETS . '/images/radio-player-ads-icon.png'; ?>">
</div>

<div class="notice-main">

    <div class="notice-text">
        <h3 class="notice-title">
			<?php _e( 'Update Required Radio Player Ads ', 'radio-player' ); ?>
        </h3>
        <p>
			<?php _e( 'A new update (v1.0.7) is available for the Radio Player Ads Add-on. Please update to the latest version to ensure full compatibility and proper functionality with the Radio Player plugin.', 'radio-player' ); ?>
        </p>
        <a href="#" class="button button-link-delete hide_notice"><?php _e( 'Dismiss', 'radio-player' ); ?></a>
        <a href="<?php echo esc_url( rp_fs()->get_addons_url() ); ?>" class="button button-primary"><?php _e( 'Get Update', 'radio-player' ); ?></a>
    </div>


</div>

<script>
    ;(function ($) {
        $(document).ready(function () {
            $('.hide_notice').on('click', function (e) {
                e.preventDefault();
                wp.ajax.post('rp_hide_radio_player_ads_update_notice');
                $('.radio-player-ads-addon-notice').slideUp();
            });
        });
    })(jQuery);
</script>