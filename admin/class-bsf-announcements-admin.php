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
if ( ! class_exists( 'BSF_Announcements_Admin' ) ) {

	class BSF_Announcements_Admin {

		/**
		 * The unique instance of the plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 * @var      BSF_Announcements_Admin    $instance    Maintains Instance in a variable.
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
		 * Initialize the class and set its properties.
		 *
		 * @since    1.0.0
		 * @param      string    $plugin_name       The name of this plugin.
		 * @param      string    $version    The version of this plugin.
		 */
		public function __construct() {

			add_action( 'init', array( $this, 'register_bsf_announcements_post_type' ) );

			add_action( 'add_meta_boxes', array( $this, 'meta_box_settings' ) );

			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		}

		/**
		 * Register Site Post & Site Taxonomies
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function register_bsf_announcements_post_type() {

			/**
			 * Register Post Type
			 *
			 * Register "BSF Announcements" post type.
			 */
			$labels = array(
				'name'               => _x( 'Announcement', 'post type general name', 'bsf-announcements' ),
				'singular_name'      => _x( 'Announcement', 'post type singular name', 'bsf-announcements' ),
				'menu_name'          => _x( 'Announcement', 'admin menu', 'bsf-announcements' ),
				'name_admin_bar'     => _x( 'Announcement', 'add new on admin bar', 'bsf-announcements' ),
				'add_new'            => _x( 'Add New', 'new portfolio item', 'bsf-announcements' ),
				'add_new_item'       => __( 'Add New Announcement', 'bsf-announcements' ),
				'new_item'           => __( 'New Announcement', 'bsf-announcements' ),
				'edit_item'          => __( 'Edit Announcement', 'bsf-announcements' ),
				'view_item'          => __( 'View Announcement', 'bsf-announcements' ),
				'all_items'          => __( 'All Announcements', 'bsf-announcements' ),
				'search_items'       => __( 'Search Announcement', 'bsf-announcements' ),
				'parent_item_colon'  => __( 'Parent Announcement:', 'bsf-announcements' ),
				'not_found'          => __( 'No Announcement found.', 'bsf-announcements' ),
				'not_found_in_trash' => __( 'No Announcement found in Trash.', 'bsf-announcements' ),
			);

			$args = apply_filters(
				'bsf_announcements_post_type_args',
				array(
					'labels'                => $labels,
					'description'           => __( 'Description.', 'bsf-announcements' ),
					'public'                => true,
					'publicly_queryable'    => true,
					'show_ui'               => true,
					'show_in_menu'          => true,
					'query_var'             => true,
					'has_archive'           => true,
					'hierarchical'          => false,
					'menu_position'         => null,
					'menu_icon'             => 'dashicons-megaphone',
					'show_in_rest'          => true,
					'rest_base'             => 'bsf-announcements',
					'rest_controller_class' => 'WP_REST_Posts_Controller',
					'supports'              => array( 'title' ),
				)
			);

			register_post_type( 'bsf-announcements', $args );
		}

		/**
		 * Load Admin Scripts
		 *
		 * @since 1.0.0
		 *
		 * @param  string $hook Current page hook.
		 * @return void
		 */
		static public function admin_scripts( $hook = '' ) {

			if ( 'bsf-announcements' !== get_current_screen()->id && 'edit-bsf-announcements' !== get_current_screen()->id ) {
				return;
			}

			wp_enqueue_script( 'bsf-announcements-admin', BSF_ANNOUNCEMENTS_BASE_URL . 'admin/js/' . BSF_Announcements_Helper::get_instance()->get_assets_js_path( 'bsf-announcements-admin' ), array( 'wp-util', 'jquery' ), BSF_ANNOUNCEMENTS_VERSION, true );
			wp_enqueue_style( 'bsf-announcements-admin', BSF_ANNOUNCEMENTS_BASE_URL . 'admin/css/' . BSF_Announcements_Helper::get_instance()->get_assets_css_path( 'bsf-announcements-admin' ), null, BSF_ANNOUNCEMENTS_VERSION, 'all' );
		}

		/**
		 * Register meta box(es) for BSF-Announcements Post Type.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		function meta_box_settings() {

			if ( 'bsf-announcements' !== get_post_type() ) {
				return;
			}

			add_meta_box( 'bsf-announcements', __( 'BSF Announcement Settings', 'bsf-announcements' ), array( $this, 'ultimate_meta_box_callback' ) );
		}

		/**
		 * Meta box display callback.
		 *
		 * @since 1.0.0
		 *
		 * @param WP_Post $post Current post object.
		 * @return void
		 */
		public function ultimate_meta_box_callback( $post ) {

			// Get Announcement Post ID.
			$site_id = get_post_meta( $post->ID, 'portfolio-blog-id', true );

			$site_url          				= 		get_post_meta( $post->ID, 'portfolio-site-url', true );
			$call_to_action    				= 		get_post_meta( $post->ID, 'portfolio-site-call-to-action', true );

			?>
				<table class="widefat ultimate-portfolio-table">
					<tr class="ultimate-portfolio-row">
						<td class="ultimate-portfolio-heading"><?php _e( 'Site URL', 'ultimate-portfolio' ); ?></td>
						<td class="ultimate-portfolio-content current-portfolio-type">
							<?php
								echo $site_url;
							?>
						</td>
					</tr>
					<tr class="ultimate-portfolio-row">
						<td class="ultimate-portfolio-heading"><?php _e( 'Thumbnail Image', 'ultimate-portfolio' ); ?>
							<span class="portfolio-help-tooltip">
								<i class="portfolio-field-help dashicons dashicons-editor-help"></i>
								<span class="portfolio-tooltip-text"> <?php _e( 'Add your project\'s thumbnail image which will display on the showcaser card.', 'ultimate-portfolio' ); ?> </span>
							</span>
						</td>
						<td class="ultimate-portfolio-content">
							<div class="ultimate-portfolio-image">
								<?php echo $call_to_action; ?>
							</div>
						</td>
					</tr>
				</table>
			<?php
		}
	}

	/**
	 *  Prepare if class 'BSF_Announcements_Admin' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
	BSF_Announcements_Admin::get_instance();
}
