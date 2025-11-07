<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.resmed.com/
 * @since      1.0.0
 *
 * @package    Rent_A_Car
 * @subpackage Rent_A_Car/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Rent_A_Car
 * @subpackage Rent_A_Car/includes
 * @author     Pinakpani Joshi <joshipinakpani@gmail.com>
 */
class Rent_A_Car_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'rent-a-car',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
