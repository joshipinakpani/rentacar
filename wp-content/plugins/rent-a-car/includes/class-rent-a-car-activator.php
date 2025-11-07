<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.resmed.com/
 * @since      1.0.0
 *
 * @package    Rent_A_Car
 * @subpackage Rent_A_Car/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Rent_A_Car
 * @subpackage Rent_A_Car/includes
 * @author     Pinakpani Joshi <joshipinakpani@gmail.com>
 */
class Rent_A_Car_Activator {

	/**
	 * Code to run on plugin activation.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		self::create_rent_a_car_page();
		// Flush rewrite rules to ensure new slugs work
		flush_rewrite_rules();

	}

	/**
	 * Create the "Rent a Car" page under /products/cars/rent-a-car/
	 *
	 * @since 1.0.0
	 */
	public static function create_rent_a_car_page() {

	    // Ensure the "Products" page exists
	    $products_page = get_page_by_path( 'products' );
	    if ( ! $products_page ) {
	        $products_page_id = wp_insert_post( array(
	            'post_title'   => 'Products',
	            'post_name'    => 'products',
	            'post_status'  => 'publish',
	            'post_type'    => 'page',
	        ) );
	        $products_page = get_post( $products_page_id );
	    }

	    // Ensure the "Cars" page exists
	    $cars_page = get_page_by_path( 'products/cars' );
	    if ( ! $cars_page ) {
	        $cars_page_id = wp_insert_post( array(
	            'post_title'   => 'Cars',
	            'post_name'    => 'cars',
	            'post_status'  => 'publish',
	            'post_type'    => 'page',
	            'post_parent'  => $products_page->ID,
	        ) );
	        $cars_page = get_post( $cars_page_id );
	    }

	    // Ensure the "Rent a Car" page exists
	    $rent_page = get_page_by_path( 'products/cars/rent-a-car' );
	    if ( ! $rent_page ) {
	        $rent_page_id = wp_insert_post( array(
	            'post_title'     => 'Rent a Car',
	            'post_name'      => 'rent-a-car',
	            'post_content'   => '[rent_a_car_slider]', 
	            'post_status'    => 'publish',
	            'post_type'      => 'page',
	            'post_parent'    => $cars_page->ID,
	        ) );
	        $rent_page = get_post( $rent_page_id );
	    }
	}
}
