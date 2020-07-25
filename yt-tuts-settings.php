<?php
/**
 * Plugin Name: Settings Page Tutorial.
 * Plugin URI: https://www.youtube.com/watch?v=DsAoi1CewpE
 * Description: Example plugin for YouTube tutorial.
 * Author: David Chandra Purnama
 * Author URI: https://www.youtube.com/c/turtlepod
 * License: GPLv2 or later
 */

/**
 * Add Settings Page.
 *
 * @link https://developer.wordpress.org/reference/functions/add_options_page/
 */
function mys_add_admin_page() {
	add_options_page(
		'My Tutorial Settings Page',
		'My Setting Example',
		'manage_options',
		'mys',
		function() {
			?>
			<div class="wrap">
				<h1>My Tutorial Settings Page</h1>
				<form method="post" action="options.php">
					<?php do_settings_sections( 'mys' ); ?>
					<?php settings_fields( 'mys' ); ?>
					<?php submit_button(); ?>
				</form>
			</div>
			<?php
		},
	);
}
add_action( 'admin_menu', 'mys_add_admin_page' );

/**
 * Register Settings.
 *
 * @link https://developer.wordpress.org/reference/functions/register_setting/
 * @link https://developer.wordpress.org/reference/functions/add_settings_section/
 * @link https://developer.wordpress.org/reference/functions/add_settings_field/
 */
function mys_register_settings() {
	// Register Settings.
	register_setting(
		'mys',
		'mys', // get_option( 'mys' );
		[
			'sanitize_callback' => function( $input ) {
				return strip_tags( $input );
			},
		],
	);

	// Add section.
	add_settings_section(
		'mys_section',
		'My Section',
		'__return_false',
		'mys'
	);

	// Add field.
	add_settings_field(
		'mys_field',
		'Text Field Test',
		function() {
			?>
			<p><input type="text" value="<?php echo esc_attr( get_option( 'mys' ) ); ?>" name="mys" class="regular-text" placeholder="Tulis disini!"></p>
			<?php
		},
		'mys',
		'mys_section'
	);
}
add_action( 'admin_init', 'mys_register_settings' );
