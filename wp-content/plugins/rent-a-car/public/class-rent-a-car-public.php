<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.resmed.com/
 * @since      1.0.0
 *
 * @package    Rent_A_Car
 * @subpackage Rent_A_Car/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Rent_A_Car
 * @subpackage Rent_A_Car/public
 * @author     Pinakpani Joshi <joshipinakpani@gmail.com>
 */
class Rent_A_Car_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rent_A_Car_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rent_A_Car_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css', array(), '12.0.0' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rent-a-car-public.css', array('swiper-css'), $this->version );


	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rent_A_Car_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rent_A_Car_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js', array(), '12.0.0', true );
		wp_enqueue_script( $this->plugin_name . '-public', plugin_dir_url( __FILE__ ) . 'js/rent-a-car-public.js', array( 'jquery', 'swiper-js' ), $this->version, true );
		wp_localize_script( $this->plugin_name . '-public', 'rentACarData', array(
			'restUrl' => esc_url_raw( rest_url( 'rent-a-car/v1/cars' ) ),
			'pluginUrl'   => plugin_dir_url( __FILE__ ),
		));

	}

	/**
	 * Returns the parsed [rent_a_car_slider] shortcode.
	 *
	 * @param array   {
	 *     Attributes of the shortcode.
	 *
	 *     @type string $id ID of...
	 * }
	 * @param string  Shortcode content.
	 *
	 * @return string HTML content to display the shortcode.
	 * 
	 * @since    1.0.0
	 */
	public function render_rent_a_car_slider( $atts = [] ) {
		$atts = shortcode_atts( array(
			'limit' => -1,
		), $atts, 'rent_a_car_slider' );
		ob_start();
		include plugin_dir_path( __FILE__ ).'partials/cars-rent-a-car.php';
		return ob_get_clean();
	}

}
