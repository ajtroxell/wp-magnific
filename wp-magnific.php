<?php
	/*
	Plugin Name: WP Magnific
	Plugin URI:	https://bitbucket.org/atroxell/wp-magnific
	Description: Makes usage of Magnific-Popup in Wordpress simple. Any images linked to larger versions, as well as galleries automatically open in Magnific-Popup. Even supports captions by default.
	Version: 1.0.0
	Author: AJ Troxell
	License: GNU General Public License v2
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
	Domain Path: /languages
	Text Domain: wp-magnific
	Bitbucket Plugin URI: https://bitbucket.org/atroxell/wp-magnific
	Bitbucket Branch: master
	*/

	function wp_magnific() {
	    wp_enqueue_script( 'wp_magnific_jquery', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.magnific-popup.min.js' );
	    	wp_enqueue_script('wp_magnific_jquery');

	    wp_enqueue_script( 'wp_magnific_js', plugin_dir_url( __FILE__ ) . 'assets/js/wp-magnific.min.js' );
	    	wp_enqueue_script('wp_magnific_js');

	    wp_enqueue_style( 'wp_magnific_css', plugin_dir_url( __FILE__ ) . 'assets/css/magnific-popup.min.css' );
	    	wp_enqueue_script('wp_magnific_css');
	}
	add_action( 'wp_enqueue_scripts', 'wp_magnific' );

?>
