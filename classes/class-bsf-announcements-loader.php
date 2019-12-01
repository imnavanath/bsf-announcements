<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       https://brainstormforce.com/
 * @since      1.0.0
 *
 * @package    BSF_Announcements
 * @subpackage BSF_Announcements/classes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    BSF_Announcements
 * @subpackage BSF_Announcements/classes
 * @author     Brainstorm Force <support@bsf.io>
 */
if ( ! class_exists( 'BSF_Announcements_Loader' ) ) {

	class BSF_Announcements_Loader {

		/**
		 * The unique instance of the plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 * @var      BSF_Announcements_Loader    $instance    Maintains Instance in a variable.
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
		 * Define the core functionality of the plugin.
		 *
		 * Set the plugin name and the plugin version that can be used throughout the plugin.
		 * Load the dependencies, define the locale, and set the hooks for the admin area and
		 * the public-facing side of the site.
		 *
		 * @since    1.0.0
		 */
		public function __construct() {
			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		}

		/**
		 * Load BSF Announcements Text Domain.
		 * This will load the translation textdomain depending on the file priorities.
		 *      1. Global Languages /wp-content/languages/bsf-announcements/ folder
		 *      2. Local dorectory /wp-content/plugins/bsf-announcements/languages/ folder
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function load_textdomain() {
			/**
			 * Filters the languages directory path to use for BSF Announcements.
			 *
			 * @param string $lang_dir The languages directory path.
			 */
			$lang_dir = apply_filters( 'bsf_announcements_domain_loader', BSF_ANNOUNCEMENTS_ROOT . '/languages/' );
			load_plugin_textdomain( 'bsf-announcements', false, $lang_dir );
		}
	}

	/**
	 *  Prepare if class 'BSF_Announcements' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
	BSF_Announcements_Loader::get_instance();
}
