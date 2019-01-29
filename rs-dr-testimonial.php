<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://therssoftware.com/
 * @since             1.0.0
 * @package           Rs_Dr_Testimonial
 *
 * @wordpress-plugin
 * Plugin Name:       RS Testimonial
 * Plugin URI:        http://therssoftware.com/
 * Description:       Shows testimonials in the front-end. Grant the user control over mode of display of testimonials
 * Version:           1.0.0
 * Author:            Deep Rahman
 * Author URI:        http://therssoftware.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rs-dr-testimonial
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rs-dr-testimonial-activator.php
 */
function activate_rs_dr_testimonial() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rs-dr-testimonial-activator.php';
	Rs_Dr_Testimonial_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rs-dr-testimonial-deactivator.php
 */
function deactivate_rs_dr_testimonial() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rs-dr-testimonial-deactivator.php';
	Rs_Dr_Testimonial_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rs_dr_testimonial' );
register_deactivation_hook( __FILE__, 'deactivate_rs_dr_testimonial' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rs-dr-testimonial.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rs_dr_testimonial() {

	$plugin = new Rs_Dr_Testimonial();
	$plugin->run();

}
run_rs_dr_testimonial();
