<?php

/**
 * The plugin bootstrap file
 *
 * @link              https://allsteeply.com
 * @since             1.0.0
 * @package           Steeply_Ref
 *
 * @wordpress-plugin
 * Plugin Name:       SteeplyRef - Affiliate & Referral
 * Description:       Affiliate & Referral System for easy integration into your website.
 * Version:           1.0.8
 * Author:            Artur Khylskyi
 * Author URI:        https://allsteeply.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       steeply-ref
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'STEEPLY_REF_VERSION', '1.0.8' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-steeply-ref-activator.php
 */
function activate_steeply_ref() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-steeply-ref-activator.php';
	Steeply_Ref_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-steeply-ref-deactivator.php
 */
function deactivate_steeply_ref() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-steeply-ref-deactivator.php';
	Steeply_Ref_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_steeply_ref' );
register_deactivation_hook( __FILE__, 'deactivate_steeply_ref' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-steeply-ref.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_steeply_ref() {

	$plugin = new Steeply_Ref();
	$plugin->run();

}
run_steeply_ref();
