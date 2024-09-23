<div id="ads-player-addon" class="getting-started-content">

	<section class="section-introduction section-full">
		<div class="col-description">
			<h2><?php esc_html_e( 'Radio Ads Player Addon - Quick Overview', 'radio-player' ); ?></h2>

			<p>
				<?php esc_html_e( 'The Radio Player Ads Addon offers you the ability to monetize your radio player by allowing you to play
                audio advertisements and other promotional content while your users listen to the radio.', 'radio-player' ); ?>
			</p>
			<p>
				<?php esc_html_e( 'You can now easily manage and create your own audio campaigns, target your desired audience, and
                increase your revenue stream.', 'radio-player' ); ?>
			</p>

			<p>
				<?php esc_html_e( 'With its user-friendly interface and easy integration with the existing
                Radio Player plugin, you can quickly and effortlessly create a professional audio campaign.
                Radio Player Ads is an excellent tool that can help you take your radio website to the next level and
                improve your overall user experience.', 'radio-player' ); ?>
			</p>

		</div>

		<div class="col-image">
			<iframe
				src="https://www.youtube.com/embed/J3-awEWXFIU?rel=0"
				frameBorder="0"
				allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
				allowFullScreen>
			</iframe>
		</div>
	</section>

	<div class="content-heading">
		<h2><?php esc_html_e( 'How to Play Custom Audio Ads and Promos Using Radio Player Ads Addon', 'radio-player' ); ?></h2>
		<p><?php esc_html_e( 'To play custom audio ads and promos, follow these steps:', 'radio-player' ); ?></p>
	</div>

	<section class="section-radio-player-ads">
		<div class="col-description">

			<h3><?php esc_html_e( 'Create Audio Ads', 'radio-player' ); ?></h3>

			<p><?php esc_html_e( 'To create audio ads, follow these steps:', 'radio-player' ); ?></p>

			<ol>
				<li><?php printf( __( 'Navigate to %s Radio Player Ads > Add New Ad > Enter Ad Title %s.', 'radio-player' ), '<strong>', '</strong>' ) ?> </li>

				<li><?php printf( __( 'From the %s General Tab %s, set up general ad settings:', 'radio-player' ), '<strong>', '</strong>' ) ?>

					<ul>
						<li><?php printf( __( '%s Ad Source:%s Enter the audio ad file URL or select the ad file from the WordPress media library.', 'radio-player' ), '<strong>', '</strong>' ) ?></li>

						<li><?php printf( __( '%s Ad Image: %s Enter the ad image URL or select the ad image from local storage.', 'radio-player' ), '<strong>', '</strong>' ) ?>
						</li>

						<li><?php printf( __( '%s Ad Playback Mode: %s Select the ad playback mode from 2 different types:', 'radio-player' ), '<strong>', '</strong>' ) ?>
							<ul>
								<li><?php printf( __( '%sOverlay:%s The ad will play in the background while the radio is playing.', 'radio-player' ), '<strong>', '</strong>' ) ?></li>
								<li><?php printf( __( '%sInterrupt:%s The ad will pause the radio stream and play the ad.', 'radio-player' ), '<strong>', '</strong>' ) ?></li>
							</ul>
						</li>

						<li><?php printf( __( '%s Ad Placement: %s Select the ad type from 3 different types of ads:', 'radio-player' ), '<strong>', '</strong>' ) ?>
							<ul>
								<li><?php printf( __( '%sPre-roll:%s The ad will be played before the radio station play starts.', 'radio-player' ), '<strong>', '</strong>' ) ?></li>
								<li><?php printf( __( '%sMid-roll:%s The ad will be played in the middle of the radio station play.', 'radio-player' ), '<strong>', '</strong>' ) ?></li>
								<li><?php printf( __( '%sBoth:%s The ad will be played before and in the middle of the radio station play.', 'radio-player' ), '<strong>', '</strong>' ) ?></li>
							</ul>
						</li>

						<li><?php printf( __( '%s Ad Duration:%s Select the ad duration and how long the ad will play. You can select 10 sec, 20 sec, 30 sec, 1 min, full length, and custom length.', 'radio-player' ), '<strong>', '</strong>' ) ?>
						</li>

						<li><?php printf( __( '%sPlayers:%s Select specific radio players where you want to play ads. The ad will be played only for the selected players.', 'radio-player' ), '<strong>', '</strong>' ) ?>
						</li>
					</ul>
				</li>

				<li><?php printf( __( 'From the %sExpiration Tab%s, customize ad expiration settings:', 'radio-player' ), '<strong>', '</strong>' ) ?>
					<ul>
						<li><?php printf( __( '%sExpiration Type:%s Select the ad expiration type depending on your need:', 'radio-player' ), '<strong>', '</strong>' ) ?>
							<ul>
								<li><?php printf( __( '%sExpire by Count:%s The ad will be expired after the given number of plays.', 'radio-player' ), '<strong>', '</strong>' ) ?></li>
								<li><?php printf( __( '%sExpire by Date:%s The ad will be expired after the given date.', 'radio-player' ), '<strong>', '</strong>' ) ?></li>
							</ul>
						</li>
					</ul>
				</li>

				<li><?php printf( __( 'From the %s Advertiser Tab %s, enter advertiser information:', 'radio-player' ), '<strong>', '</strong>' ) ?>
					<ul>
						<li><?php printf( __( '%s Advertiser Name:%s Enter the advertiser name', 'radio-player' ), '<strong>', '</strong>' ) ?></li>
						<li><?php printf( __( '%s Advertiser Email:%s Enter the advertiser email (this email is used to send email reports of ad playing statistics).', 'radio-player' ), '<strong>', '</strong>' ) ?>
						</li>
					</ul>
				</li>

				<li><?php printf( __( 'Select the %1$s Ad Status %2$s and click %1$sPublish%2$s when customizations are done.', 'radio-player' ), '<strong>', '</strong>' ) ?>
				</li>
			</ol>


			<h3><?php esc_html_e( 'Adjust Ad Settings', 'radio-player' ); ?></h3>
			<p><?php esc_html_e( 'To adjust ad settings, follow these steps:', 'radio-player' ); ?></p>

			<ul>
				<li>
					<?php printf( __( 'Navigate to %s Radio Player > Settings %s.', 'radio-player' ), '<strong>', '</strong>' ) ?>
				</li>

				<li>
					<?php printf( __( 'From the %s Ads Player Settings Tab %s, adjust the following settings:', 'radio-player' ), '<strong>', '</strong>' ) ?>
					<ul>
						<li>
							<?php printf( __( '%sPre-roll Ads Interval:%s This setting allows you to configure the time interval between consecutive pre-roll ads. Pre-roll ads are played before the radio station starts playing. Adjust this interval to control how often pre-roll ads will be displayed to your listeners.', 'radio-player' ), '<strong>', '</strong>' ) ?>
						</li>
						<li>
							<?php printf( __( '%sMid-roll Ads Interval:%s This setting lets you set the time interval between consecutive mid-roll ads. Mid-roll ads are played during the radio station play, typically in the middle of the content. By adjusting this interval, you can determine how frequently mid-roll ads will be displayed to your listeners.', 'radio-player' ), '<strong>', '</strong>' ) ?>
						</li>
						<li>
							<?php printf( __( '%sShow Skip Button:%s This setting enables or disables the "Skip" button for your ads. When activated, listeners will have the option to skip the ad after a certain duration or if they find it irrelevant. Enabling this feature can improve the user experience, but may also affect ad revenue. Be sure to weigh the pros and cons before enabling or disabling this option.', 'radio-player' ), '<strong>', '</strong>' ) ?>
						</li>
					</ul>

				</li>
			</ul>

			<p><?php esc_html_e( 'When anyone plays the radio, the ads will keep displaying depending on the settings you have customized so far.', 'radio-player' ); ?></p>

			<h3><?php esc_html_e( 'Video Tutorial', 'radio-player' ); ?></h3>

			<div class="col-image">
				<iframe
					src="https://www.youtube.com/embed/lrDCHPzjHB4?rel=0"
					frameBorder="0"
					allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
					allowFullScreen>
				</iframe>
			</div>

		</div>
	</section>


</div>