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
if ( ! class_exists( 'BSF_Announcements_Helper' ) ) {

	class BSF_Announcements_Helper {

		/**
		 * The unique instance of the plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 * @var      BSF_Announcements_Helper    $instance    Maintains Instance in a variable.
		 */
		private static $instance;

		/**
		 * Gets an instance of our plugin.
		 * 
		 * @since    1.0.0
		 */
		public static function get_instance() {

			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

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

	/**
	 *  Prepare if class 'BSF_Announcements_Helper' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
	BSF_Announcements_Helper::get_instance();
}
