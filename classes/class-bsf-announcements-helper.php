<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://brainstormforce.com/
 * @since      1.0.0
 *
 * @package    BSF_Announcements
 * @subpackage BSF_Announcements/classes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    BSF_Announcements
 * @subpackage BSF_Announcements/classes
 * @author     Brainstorm Force <support@bsf.io>
 */
class BSF_Announcements_Helper {

	/**
	 * Load assets JS path
	 *
	 * @since 1.0.0
	 *
	 * @param  string $js_file_name JS file name.
	 * @return string               JS minified file path.
	 */
	public static function get_assets_js_path( $js_file_name = '' ) {

		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			return $js_file_name . '.js';
		}

		return 'min/' . $js_file_name . '.min.js';
	}

	/**
	 * Load assets CSS path
	 *
	 * @since 1.0.0
	 *
	 * @param  string $css_file_name CSS file name.
	 * @return string                CSS minified file path.
	 */
	public static function get_assets_css_path( $css_file_name = '' ) {

		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			return $css_file_name . '.css';
		}

		return 'min/' . $css_file_name . '.min.css';
	}
}
