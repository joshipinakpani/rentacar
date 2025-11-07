<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.resmed.com/
 * @since      1.0.0
 *
 * @package    Rent_A_Car
 * @subpackage Rent_A_Car/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rent_A_Car
 * @subpackage Rent_A_Car/admin
 * @author     Pinakpani Joshi <joshipinakpani@gmail.com>
 */
class Rent_A_Car_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rent-a-car-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rent-a-car-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Registers the "cars" custom post type.
	 *
	 * @since 1.0.0
	 */
	public function car_cpt_register() {

		$labels = array(
			'name'                  => _x( 'Cars', 'Post Type General Name', $this->plugin_name ),
			'singular_name'         => _x( 'Car', 'Post Type Singular Name', $this->plugin_name ),
			'menu_name'             => __( 'Cars', $this->plugin_name ),
			'name_admin_bar'        => __( 'Car', $this->plugin_name ),
			'add_new'               => __( 'Add New', $this->plugin_name ),
			'add_new_item'          => __( 'Add New Car', $this->plugin_name ),
			'edit_item'             => __( 'Edit Car', $this->plugin_name ),
			'new_item'              => __( 'New Car', $this->plugin_name ),
			'view_item'             => __( 'View Car', $this->plugin_name ),
			'view_items'            => __( 'View Cars', $this->plugin_name ),
			'search_items'          => __( 'Search Cars', $this->plugin_name ),
			'not_found'             => __( 'No cars found', $this->plugin_name ),
			'not_found_in_trash'    => __( 'No cars found in Trash', $this->plugin_name ),
			'all_items'             => __( 'All Cars', $this->plugin_name ),
			'archives'              => __( 'Car Archives', $this->plugin_name ),
			'attributes'            => __( 'Car Attributes', $this->plugin_name ),
			'parent_item_colon'     => __( 'Parent Car:', $this->plugin_name ),
		);

		$args = array(
			'labels'                => $labels,
			'description'           => __( 'Custom post type for managing cars.', $this->plugin_name ),
			'public'                => true,
			'has_archive'           => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'show_in_rest'          => true, // enables REST API
			'publicly_queryable'    => true,
			'exclude_from_search'   => false,
			'query_var'             => true,
			'can_export'            => true,
			'rest_base'    			=> 'cars',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-car',
			'capability_type'       => 'post',
			'supports'              => array(
				'title',
				'excerpt',
				'thumbnail',
				'editor',
			),
		);

		register_post_type( 'cars', $args );

		// include in REST API output (_car_price, _car_external_link).
		register_post_meta( 'cars', '_car_price', array(
			'type' => 'string',
			'single' => true,
			'show_in_rest' => true,
		) );

		register_post_meta( 'cars', '_car_external_link', array(
			'type' => 'string',
			'single' => true,
			'show_in_rest' => true,
		) );

	}

	/**
	 * Adds custom meta boxes for Cars CPT.
	 *
	 * @since 1.0.0
	 */
	public function add_car_meta_boxes() {
		add_meta_box(
			'car_details_box',
			__( 'Car Details', $this->plugin_name ),
			array( $this, 'render_car_meta_box' ),
			'cars',
			'normal',
			'default'
		);
	}

	/**
	 * Renders the meta box fields.
	 *
	 * @param WP_Post $post The current post object.
	 */
	public function render_car_meta_box( $post ) {
		include_once plugin_dir_path( __FILE__ ) . 'partials/render-car-meta-box.php';
	}

	/**
	 * Saves the custom meta fields when the cars CPT is saved.
	 *
	 * @param int $post_id The post ID.
	 * @since 1.0.0
	 */
	public function save_car_meta( $post_id ) {

		// Security check: verify nonce
	    if ( empty( $_POST['car_details_nonce'] ) || 
	         ! wp_verify_nonce( $_POST['car_details_nonce'], 'save_car_details' ) ) {
	        return;
	    }

	    // Ensure this is cars CPT
	    if ( get_post_type( $post_id ) !== 'cars' ) return;

	    // Permission check
	    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	    $fields = array(
	        '_car_price'         => isset( $_POST['car_price'] ) ? sanitize_text_field( $_POST['car_price'] ) : '',
	        '_car_external_link' => isset( $_POST['car_external_link'] ) ? esc_url_raw( $_POST['car_external_link'] ) : '',
	    );

	    // Loop through fields and update
	    foreach ( $fields as $key => $value ) {
	        update_post_meta( $post_id, $key, $value );
	    	// Clean up empty fields from database (commented code because in rest api it may be needed to return blank values)
	        // if ( ! empty( $value ) ) {
	        //     update_post_meta( $post_id, $key, $value );
	        // } else {
	        //     delete_post_meta( $post_id, $key ); 
	        // }
	    }
	}


}
