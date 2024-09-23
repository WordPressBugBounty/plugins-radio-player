<?php

$logs = [
	'v2.0.81' => [
		'date' => '18 September, 2024',
		'fix'  => [
			'Fixed player took long time to load the page on IOS mobile device.',
			'Fixed Ads Player compatibility issue with the Radio Player plugin.',
		],
	],
	'v2.0.79' => [
		'date'        => '16 September, 2024',
		'fix'         => [
			'Fixed translation issue.',
		],
		'enhancement' => [
			'Improved Ads Player Add-on compatibility.',
			'Improved overall performance and security.',
		],
	],
	'v2.0.78' => [
		'date'        => '12 August, 2024',
		'new'         => [
			'Added stations playlist height control settings.',
		],
		'enhancement' => [
			'Improved overall plugin UI design and performance.',
			'Added support up to WordPress 6.6.1',
		],
	],
	'v2.0.77' => [
		'date'        => '09 July, 2024',
		'new'         => [
			'Added next playlist item playback on end.',
		],
		'fix'         => [
			'Fixed compatibility issue with Proxy Player Add-on.',
			'Fixed compatibility issue with Ads Player Add-on.',
			'Fixed sticky player not displaying issue.',
		],
		'enhancement' => [
			'Improved overall performance and security.',
		],
	],
	'v2.0.76' => [
		'date'        => '07 May, 2024',
		'new'         => [
			'Added option to customize the player playlist height.',
		],
		'enhancement' => [
			'Enable Keyboard Accessibility for the Volume Slider.',
			'Improved overall performance and security.',
		],
	],
	'v2.0.75' => [
		'date'        => '19 March, 2024',
		'new'         => [
			'Added current song title metadata text scrolling speed setting.',
			'Added automatically reconnect the audio player when the internet connection is restored.',
		],
		'fix'         => [
			'Fixed radio player is not displaying properly.',
		],
		'enhancement' => [
			'Improved overall security and performance.',
		],
	],

	'v2.0.73' => [
		'date'        => '31 October, 2023',
		'fix'         => [
			'Fixed volume control not working in Firefox.',
			'Fixed top sticky player volume control not showing properly.',
			'Fixed popup player font style issue.',
		],
		'enhancement' => [
			'Improved security and performance.',
		],
	],
	'v2.0.72' => [
		'date' => '21 August, 2023',
		'new'  => [
			'Added Proxy Player add-on compatibility.',
			'Added Metadata Update frequency setting to control the frequency to update the stream data.',
		],
		'fix'  => [
			'Fixed HTTP stream playback not working on iPhone.',
			'Fixed multiple players on the same page not showing the metadata.',
		],

	],
	'v2.0.71' => [
		'date'        => '04 August, 2023',
		'new'         => [
			'Added Affiliation to earn money by referring users',
		],
		'fix'         => [
			'Fixed Export/Import not working properly',
		],
		'enhancement' => [
			'Improved stream data fetching to display now playing song information',
		],

	],
	'v2.0.7'  => [
		'date'        => '25 July, 2023',
		'new'         => [
			'Added Export, Import and Reset Settings',
		],
		'enhancement' => [
			'Added Always Popup settings',
			'Security related enhancements',
		]

	],
	'v2.0.6'  => [
		'date' => '28 June, 2023',
		'fix'  => [
			'Fixed sweetalert2 malicious code issue',
		],

	],
	'v2.0.5'  => [
		'date'        => '28 June, 2023',
		'new'         => [
			'Add player listing page pagination.',
			'Added schedule option to display player on specific time.',
			'Added local media file selector for the player stream.',
		],
		'fix'         => [
			'Fixed MYSQL old version compatibility issues.',
			'Fixed player broken styles issues.',
		],
		'enhancement' => [
			'Improved player edit screen.',
			'Improved player UI.',
			'Improved dashboard statistics widget.',
		],
		'remove'      => [
			'Removed Always Popup option.',
		],
	],
	'v2.0.4'  => [
		'date' => '06 April, 2023',
		'new'  => [
			'Added WordPress 6.2 compatibility',
			'Added multi selection for the player list.',
		],
		'fix'  => [
			'Fixed minor issues and bugs',
		],
	],
	'v2.0.3'  => [
		'date'        => '23 March, 2023',
		'new'         => [
			'Added Radio Player Ads - Add-on compatibility',
			'Added Desktop/Mobile Player Preview when editing the player',
			'Added RTL CSS support',
		],
		'fix'         => [
			'Fixed conflict with WooCommerce plugin',
		],
		'enhancement' => [
			'Improved Radio Player block for Gutenberg',
		],
	],
	'v2.0.2'  => [
		'date' => '02 FEB, 2023',
		'new'  => [
			'Added responsive width control for shortcode player',
			'Added popup player header and footer content support',
			'Added Sticky player minimized image change settings',
			'Added Add recommended plugins page',
			'Added draggable position change for floating sticky player',
			'Added alignment control for the Radio Player Elementor Widget',
			'Added custom trigger button to open the popup player',
			'Added blur background option for the player based on the station thumbnail/ artwork',
		],
		'fix'  => [
			'Fixed Gutenberg Radio Player Block minor issues',
			'Fixed minor issues with statistics email report',
		],
	],
	'v2.0.1'  => [
		'date' => '22 Nov, 2022',
		'new'  => [
			'Added current track artist name & artwork image in the player.',
			'Added station play history of the recent played tracks.',
			'Added sticky player display on mobile devices show/hide settings.',
		],
		'fix'  => [
			'Fixed Multiple player play at one time issue.',
			'Fixed current song title not showing issue.',
		],
	],
	'v2.0.0'  => [
		'date'        => '20 Nov, 2022',
		'new'         => [
			'Added Embed Player feature',
			'Added New Player skins (Skin-3, Skin-10)',
			'Added multiple sticky player styles (Fullwidth, Mini, and Floating)',
			'Added sticky player position settings (Top, Bottom, Left, Right)',
			'Added Box Shadow settings for the player',
			'Add Custom CSS settings',
			'Added Always Popup Player settings.',
		],
		'fix'         => [
			'Fixed play statistics not working issue',
		],
		'enhancement' => [
			'Improved all the player skins',
			'Improved overall performance and user experience.',
			'Updated the Freeemius SDK to the latest version.',
		],
		'remove'      => [
			'Radio Player Classic Sidebar Widget.',
			'Remove Player primary color settings.',
		]
	],

];


?>

<div id="what-new" class="getting-started-content content-what-new">
    <div class="content-heading">
        <h2>What's new in the latest changes</h2>
        <p>Check out the latest change logs.</p>
    </div>

	<?php
	$i = 0;
	foreach ( $logs as $v => $log ) { ?>
        <div class="log <?php echo $i == 0 ? 'active' : ''; ?>">
            <div class="log-header">
                <span class="log-version"><?php echo $v; ?></span>
                <span class="log-date">(<?php echo $log['date']; ?>)</span>

                <i class="<?php echo $i == 0 ? 'dashicons-arrow-up-alt2' : 'dashicons-arrow-down-alt2'; ?> dashicons "></i>
            </div>

            <div class="log-body">
				<?php

				if ( ! empty( $log['new'] ) ) {
					echo '<div class="log-section new"><h3>New Features</h3>';
					foreach ( $log['new'] as $item ) {
						echo '<div class="log-item log-item-new"><i class="dashicons dashicons-plus-alt2"></i> <span>' . $item . '</span></div>';
					}
					echo '</div>';
				}


				if ( ! empty( $log['fix'] ) ) {
					echo '<div class="log-section fix"><h3>Fixes</h3>';
					foreach ( $log['fix'] as $item ) {
						echo '<div class="log-item log-item-fix"><i class="dashicons dashicons-saved"></i> <span>' . $item . '</span></div>';
					}
					echo '</div>';
				}

				if ( ! empty( $log['enhancement'] ) ) {
					echo '<div class="log-section enhancement"><h3>Enhancements</h3>';
					foreach ( $log['enhancement'] as $item ) {
						echo '<div class="log-item log-item-enhancement"><i class="dashicons dashicons-star-filled"></i> <span>' . $item . '</span></div>';
					}
					echo '</div>';
				}

				if ( ! empty( $log['remove'] ) ) {
					echo '<div class="log-section remove"><h3>Removes</h3>';
					foreach ( $log['remove'] as $item ) {
						echo '<div class="log-item log-item-remove"><i class="dashicons dashicons-trash"></i> <span>' . $item . '</span></div>';
					}
					echo '</div>';
				}


				?>
            </div>

        </div>
		<?php
		$i ++;
	} ?>


</div>


<script>
    jQuery(document).ready(function ($) {
        $('.log-header').on('click', function () {
            $(this).next('.log-body').slideToggle();
            $(this).find('i').toggleClass('dashicons-arrow-down-alt2 dashicons-arrow-up-alt2');
            $(this).parent().toggleClass('active');
        });
    });
</script>