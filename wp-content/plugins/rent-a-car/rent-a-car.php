<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.resmed.com/
 * @since             1.0.0
 * @package           Rent_A_Car
 *
 * @wordpress-plugin
 * Plugin Name:       Rent A Car
 * Plugin URI:        https://www.resmed.com/
 * Description:       A custom WordPress plugin developed as part of a technical assessment. Displays cars using a Swiper JS slider and allows filtering by brand.
 * Version:           1.0.0
 * Author:            Pinakpani Joshi
 * Author URI:        https://www.resmed.com//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rent-a-car
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
define( 'RENT_A_CAR_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rent-a-car-activator.php
 */
function activate_rent_a_car() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rent-a-car-activator.php';
	Rent_A_Car_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rent-a-car-deactivator.php
 */
function deactivate_rent_a_car() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rent-a-car-deactivator.php';
	Rent_A_Car_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rent_a_car' );
register_deactivation_hook( __FILE__, 'deactivate_rent_a_car' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rent-a-car.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rent_a_car() {

	$plugin = new Rent_A_Car();
	$plugin->run();

}
run_rent_a_car();
