<?php
	/*
	Plugin Name: WP Magnific
	Plugin URI:	https://bitbucket.org/atroxell/wp-magnific
	Description: Makes usage of Magnific-Popup in Wordpress simple. Provides caption support and custom styles.
	Version: 1.1.1
	Author: AJ Troxell
	License: GNU General Public License v2
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
	Domain Path: /languages
	Text Domain: wp-magnific
	Bitbucket Plugin URI: https://bitbucket.org/atroxell/wp-magnific
	Bitbucket Branch: master
	*/

	add_action('admin_menu', 'wp_magnific_create_menu');

	function wp_magnific_create_menu() {

		//create new top-level menu
		// add_options_page('WP Magnific Settings', 'WP Magnific', 'administrator', __FILE__, 'wp_magnific_settings_page',plugins_url('/images/icon.png', __FILE__));
		add_options_page( 'WP Magnific Settings', 'WP Magnific', 'manage_options', 'wp_magnific', 'wp_magnific_settings_page' );

		//call register settings function
		add_action( 'admin_init', 'register_mysettings' );
	}


	function register_mysettings() {
		//register our settings
		register_setting( 'wp_magnific-settings-group', 'wp_magnific_custom_stylesheet' );
	}

	function wp_magnific_settings_page() { ?>

	<div class="wrap">
		<h2>WP Magnific</h2>

		<form method="post" action="options.php">
			<?php settings_fields( 'wp_magnific-settings-group' ); ?>
			<?php do_settings_sections( 'wp_magnific-settings-group' ); ?>
			<table class="form-table">
				<tr valign="top">
				<th scope="row">Custom Stylesheet</th>
				<td>
					<textarea name="wp_magnific_custom_stylesheet" id="wp_magnific_custom_stylesheet" class="widefat" rows="30"><?php echo esc_attr( get_option('wp_magnific_custom_stylesheet') ); ?></textarea>
				</td>
				</tr>
		    </table>
		    <?php submit_button(); ?>
		</form>
	</div>

	<?php }

	function wp_magnific_validate( $input ) {
		$output = array();
		foreach( $input as $key => $value ) {
			if( isset( $input[$key] ) ) {
				$output[$key] = strip_tags( stripslashes( $input[ $key ] ) );
			}
		}
		return apply_filters( 'wp_magnific_validate', $output, $input );
	}

	function wp_magnific() {
	    wp_enqueue_script( 'wp_magnific_jquery', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.magnific-popup.min.js', array('jquery') );
	    	wp_enqueue_script('wp_magnific_jquery');

	    wp_enqueue_script( 'wp_magnific_js', plugin_dir_url( __FILE__ ) . 'assets/js/wp-magnific.min.js', array('jquery') );
	    	wp_enqueue_script('wp_magnific_js');

	    wp_enqueue_style( 'wp_magnific_css', plugin_dir_url( __FILE__ ) . 'assets/css/magnific-popup.min.css' );
	    	wp_enqueue_script('wp_magnific_css');
	}
	add_action( 'wp_enqueue_scripts', 'wp_magnific' );

	function wp_magnific_header() {
		$wp_magnific_custom_stylesheet =  get_option('wp_magnific_custom_stylesheet');
		echo "<style type='text/css'>" . sanitize_text_field($wp_magnific_custom_stylesheet) . "</style>";
	}
	add_action( 'wp_head', 'wp_magnific_header' );
?>
