<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://brainstormforce.com/
 * @since             1.0.0
 * @package           BSF_Announcements
 *
 * @wordpress-plugin
 * Plugin Name:       BSF Announcements
 * Plugin URI:        http://wpastra.com/
 * Description:       Showcase Announcements, Notices to end-users on their WordPress backend.
 * Version:           1.0.0
 * Author:            Brainstorm Force
 * Author URI:        https://brainstormforce.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bsf-announcements
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Plugin constants.
 * 
 * Start at version 1.0.0
 */

define( 'BSF_ANNOUNCEMENTS_PLUGIN_FILE' , __FILE__ );
define( 'BSF_ANNOUNCEMENTS_VERSION' , '1.0.0' );
define( 'BSF_ANNOUNCEMENTS_BASE_DIR_NAME' , plugin_basename( BSF_ANNOUNCEMENTS_PLUGIN_FILE ) );
define( 'BSF_ANNOUNCEMENTS_ROOT', dirname( BSF_ANNOUNCEMENTS_BASE_DIR_NAME ) );
define( 'BSF_ANNOUNCEMENTS_BASE_FILE' , trailingslashit( BSF_ANNOUNCEMENTS_PLUGIN_FILE ) . BSF_ANNOUNCEMENTS_BASE_DIR_NAME . '.php' );
define( 'BSF_ANNOUNCEMENTS_BASE_DIR' , plugin_dir_path( BSF_ANNOUNCEMENTS_PLUGIN_FILE ) );
define( 'BSF_ANNOUNCEMENTS_BASE_URL' , plugins_url( '/', BSF_ANNOUNCEMENTS_PLUGIN_FILE ) );
define( 'BSF_ANNOUNCEMENTS_POST_TYPE' , 'BSF Announcements' );

/**
 * The code that runs during plugin activation.
 * 
 * @since    1.0.0
 */
register_activation_hook( BSF_ANNOUNCEMENTS_PLUGIN_FILE, 'activate_bsf_announcements' );

function activate_bsf_announcements() { }

/**
 * The code that runs during plugin deactivation.
 * 
 * @since    1.0.0
 */
register_deactivation_hook( BSF_ANNOUNCEMENTS_PLUGIN_FILE, 'deactivate_bsf_announcements' );

function deactivate_bsf_announcements() { }

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
if ( ! function_exists( 'bsf_announcements_plugin_setup' ) ) :

	/**
	 * BSF Announcements Setup
	 *
	 * @since 1.0.0
	 */
	function bsf_announcements_plugin_setup() {
		require_once BSF_ANNOUNCEMENTS_BASE_DIR . 'classes/class-bsf-announcements.php';
	}

	add_action( 'plugins_loaded', 'bsf_announcements_plugin_setup' );

endif;
