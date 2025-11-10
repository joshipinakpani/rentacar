<?php
class Rent_A_Car_REST {
    public function __construct() {
        add_action( 'rest_api_init', array( $this, 'register_routes' ) );
    }

    public function register_routes() {
        register_rest_route( 'rent-a-car/v1', '/cars', array(
            'methods'  => 'GET',
            'callback' => array( $this, 'get_cars' ),
            'args'     => array(
                'brand' => array(
                    'required' => false,
                ),
            ),
        ) );
    }

    public function get_cars( $request ) {
        $brand = sanitize_text_field( $request['brand'] ?? '' );

        $args = array(
            'post_type'      => 'cars',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        );

        if ( $brand ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'brand',
                    'field'    => 'slug',
                    'terms'    => $brand,
                ),
            );
        }

        $query = new WP_Query( $args );
        $cars  = array();

        while ( $query->have_posts() ) {
            $query->the_post();
            $cars[] = array(
                'title'   => get_the_title(),
                'link'    => get_permalink(),
                'image'   => get_the_post_thumbnail_url( get_the_ID(), 'medium' ),
                'price'   => get_post_meta( get_the_ID(), '_car_price', true ),
                'external_link' => get_post_meta( get_the_ID(), '_car_external_link', true ),
                'brand'   => wp_get_post_terms( get_the_ID(), 'brand', array( 'fields' => 'names' ) ),
            );
        }

        wp_reset_postdata();
        return rest_ensure_response( $cars );
    }
}
