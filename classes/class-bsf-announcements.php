<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that classes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://brainstormforce.com/
 * @since      1.0.0
 *
 * @package    BSF_Announcements
 * @subpackage BSF_Announcements/classes
 */

defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    BSF_Announcements
 * @subpackage BSF_Announcements/classes
 * @author     Brainstorm Force <support@bsf.io>
 */

if ( ! class_exists( 'BSF_Announcements' ) ) {

	class BSF_Announcements {

		/**
		 * The unique instance of the plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 * @var      BSF_Announcements    $instance    Maintains Instance in a variable.
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
			/* Load plugin core file */
			$this->load_dependencies();
		}

		/**
		 * Load the required dependencies for this plugin.
		 *
		 * Include the following files that make up the plugin:
		 *
		 * - BSF_Announcements_Loader. Orchestrates the hooks of the plugin.
		 * - BSF_Announcements_Helper. Defines internationalization functionality.
		 * - BSF_Announcements_Admin. Defines all hooks for the admin area.
		 * - BSF_Announcements_Public. Defines all hooks for the public side of the site.
		 *
		 * Create an instance of the loader which will be used to register the hooks
		 * with WordPress.
		 *
		 * @since    1.0.0
		 * @access   private
		 */
		private function load_dependencies() {

			/**
			 * The class responsible for orchestrating the actions and filters of the
			 * core plugin.
			 */
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-bsf-announcements-loader.php';

			/**
			 * The class responsible for defining helping functionality
			 * of the plugin.
			 */
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-bsf-announcements-helper.php';

			/**
			 * The class responsible for setting up REST API.
			 */
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-bsf-announcements-rest-api.php';

			/**
			 * The class responsible for defining all actions that occur in the admin area.
			 */
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-bsf-announcements-admin.php';
		}
	}

	/**
	 *  Prepare if class 'BSF_Announcements' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
	BSF_Announcements::get_instance();
}