<?php
	/*
	Plugin Name: WP Magnific
	Plugin URI:	https://bitbucket.org/atroxell/wp-magnific
	Description: Makes usage of Magnific-Popup in Wordpress simple. Provides custom class and ID targeting, caption support, and custom styles.
	Version: 2.0.0
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
		add_options_page( 'WP Magnific Settings', 'WP Magnific', 'manage_options', 'wp_magnific', 'wp_magnific_settings_page' );

		//call register settings function
		add_action( 'admin_init', 'register_mysettings' );
	}


	function register_mysettings() {
		//register our settings
		register_setting( 'wp_magnific', 'wp_magnific_options', 'wp_magnific_validate' );
	}

	function wp_magnific_settings_page() { ?>

	<div class="wrap">
		<h2>WP Magnific</h2>

		<form method="post" action="options.php">

			<?php settings_fields( 'wp_magnific' ); ?>
			<?php $options = get_option( 'wp_magnific_options' ); ?>
			<table class="form-table">
				<?php
					$textinputs = array(
						array(
							"Input" => "elements",
							"Label" => "Target Elements",
							"Description" => "Classes or ID's of elements, comma separated. WP-Magnific will only be applied to images or galleries within these elements. Wordpress body classes, <code>.single-post</code>, work well here."
						)
					);
					foreach ( $textinputs as $input ) {
				        echo "<tr valign='top'><th scope='row'>".$input['Label']."</th><td><input id='wp_magnific_options[".$input['Input']."]' class='regular-text' type='text' name='wp_magnific_options[".$input['Input']."]' value='";
						if (!empty($options[$input['Input']])) {
							echo esc_attr_e( $options[$input['Input']] );
						}
						echo "' class='regular-text' />";
						if (!empty($input['Description'])) {
							echo "<p class='description'>".$input['Description']."</p>";
						}
						echo "</td></tr>";
					}

					$textareas = array(
						array(
							"Input" => "stylesheet",
							"Label" => "Custom Stylesheet",
							"Description" => "These will override Magnific Popup styles."
						)
					);
					foreach ( $textareas as $input ) {
				        echo "<tr valign='top'><th scope='row'>".$input['Label']."</th><td><textarea id='wp_magnific_options[".$input['Input']."]'  name='wp_magnific_options[".$input['Input']."]' rows='10' cols='50' class='large-text code'>";
						if (!empty($options[$input['Input']])) {
							echo esc_attr_e( $options[$input['Input']] );
						}
						echo "</textarea>";
						if (!empty($input['Description'])) {
							echo "<p class='description'>".$input['Description']."</p>";
						}
						echo "</td></tr>";
					}
				?>
		    </table>
		    <?php submit_button(); ?>
		</form>
	</div>

	<?php }

	function wp_magnific_validate( $input ) {
		$inputValidateArray;
		$inputValidateArray["elements"] = "elements";
		$inputValidateArray["stylesheet"] = "stylesheet";
		foreach( $inputValidateArray as $key => $value) {
			$input[$value] = $input[$value];
		}
		return $input;
	}

	function wp_magnific_script() {
		$options = get_option('wp_magnific_options');
		if (!empty($options['elements'])) {
			$elements = $options['elements'];
		}
		if( wp_script_is( 'jquery', 'done' ) ) {
	?>
		<script type="text/javascript">
		  if ( undefined !== window.jQuery ) {
		    jQuery(document).ready(function(e){var t="<?php echo $elements; ?>";e('a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"]',t).each(function(){if(e(this).parents(".gallery").length==0){e(this).magnificPopup({type:"image",image:{markup:'<div class="mfp-figure">'+'<div class="mfp-close"></div>'+'<div class="mfp-img"></div>'+'<div class="mfp-bottom-bar">'+'<div class="mfp-title"></div>'+'<div class="mfp-description"></div>'+'<div class="mfp-counter"></div>'+"</div>"+"</div>",titleSrc:function(e){return"<span>"+e.el.find("img").attr("alt")+"</span>"}}})}});e(".gallery",t).magnificPopup({delegate:"a",type:"image",image:{markup:'<div class="mfp-figure">'+'<div class="mfp-close"></div>'+'<div class="mfp-img"></div>'+'<div class="mfp-bottom-bar">'+'<div class="mfp-title"></div>'+'<div class="mfp-description"></div>'+'<div class="mfp-counter"></div>'+"</div>"+"</div>",titleSrc:function(e){return"<span>"+e.el.find("img").attr("alt")+"</span>"}},gallery:{enabled:true,navigateByImgClick:true}})})
		  }
		</script>

	<?php
		}
	}
	add_action( 'wp_footer', 'wp_magnific_script' );

	function wp_magnific() {
	    wp_enqueue_script( 'wp_magnific_jquery', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.magnific-popup.min.js', array('jquery') );
	    	wp_enqueue_script('wp_magnific_jquery');

	    wp_enqueue_style( 'wp_magnific_css', plugin_dir_url( __FILE__ ) . 'assets/css/magnific-popup.min.css' );
	    	wp_enqueue_script('wp_magnific_css');
	}
	add_action( 'wp_enqueue_scripts', 'wp_magnific' );

	function wp_magnific_header() {
		$options = get_option('wp_magnific_options');
		if (!empty($options['stylesheet'])) {
			echo "<style type='text/css'>" . sanitize_text_field($options['stylesheet']) . "</style>";
		}
	}
	add_action( 'wp_head', 'wp_magnific_header' );
?>
