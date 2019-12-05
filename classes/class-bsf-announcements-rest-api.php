<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://brainstormforce.com/
 * @since      1.0.0
 *
 * @package    BSF_Announcements
 * @subpackage BSF_Announcements/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    BSF_Announcements
 * @subpackage BSF_Announcements/admin
 * @author     Brainstorm Force <support@bsf.io>
 */
if ( ! class_exists( 'BSF_Announcements_Rset_API' ) ) {

	class BSF_Announcements_Rset_API {

		/**
		 * The unique instance of the plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 * @var      BSF_Announcements_Rset_API    $instance    Maintains Instance in a variable.
		 */
		private static $instance;

		/**
		 * API Request Start Time
		 *
		 * @since 1.0.0
		 * @access private
		 * @var string BSF_Announcements_Rset_API    $start_time		Start time.
		 */
		private static $start_time;

		/**
		 * Gets an instance of our plugin.
		 * 
		 * @access   public
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
		 * @access   public
		 * @since    1.0.0
		 */
		public function __construct() {
			add_action( 'rest_api_init', array( $this, 'setup_bsf_announcements_meta_in_rest' ) );
		}

		/**
		 * Load parameters in REST API
		 *
		 * @access public
		 * @since 1.0.0
		 * @return void
		 */
		public function setup_bsf_announcements_meta_in_rest() {

			// Start logging how long the request takes for logging.
			self::$start_time = microtime( true );

			register_rest_field(
				'bsf-announcements',
				'astra-site-call-to-action',
				array(
					'get_callback' => array( $this, 'get_post_meta' ),
					'schema'       => null,
				)
			);

			register_rest_field(
				'bsf-announcements',
				'astra-site-url',
				array(
					'get_callback' => array( $this, 'get_post_meta' ),
					'schema'       => null,
				)
			);

			register_rest_field(
				'bsf-announcements',
				'wcf_custom_filter_from',
				array(
					'get_callback' => array( $this, 'get_post_meta' ),
					'schema'       => null,
				)
			);

			register_rest_field(
				'bsf-announcements',
				'wcf_custom_filter_to',
				array(
					'get_callback' => array( $this, 'get_post_meta' ),
					'schema'       => null,
				)
			);
		}

		/**
		 * Get BSF-Announcement notice meta
		 *
		 * @since 1.0.0
		 * @param  string $object     Rest Object.
		 * @param  string $field_name Rest Field.
		 * @param  array  $request    Rest Request.
		 * @return string             Post Meta.
		 */
		public function get_post_meta( $object = '', $field_name = '', $request = array() ) {

			return get_post_meta( $object['id'], $field_name, 1 );
		}

		/**
		 * Setter for BSF-Announcements $api_url
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public static function get_api_endpoint() {
			$api_url = apply_filters( 'bsf_announcements_api_endpoint', 'http://localhost/dev/wp-json/wp/v2/' );
			return $api_url;
		}

		/**
		 * Setter for $api_url
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public static function get_sites_api_url() {
			return apply_filters( 'bsf_announcements_api_url', self::get_api_endpoint() . 'bsf-announcements/' );
		}
	}

	/**
	 *  Prepare if class 'BSF_Announcements_Rset_API' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
	BSF_Announcements_Rset_API::get_instance();
}
