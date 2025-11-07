<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.resmed.com/
 * @since      1.0.0
 *
 * @package    Rent_A_Car
 * @subpackage Rent_A_Car/admin/partials
 */

// Retrieve existing values
$price = get_post_meta( $post->ID, '_car_price', true );
$link  = get_post_meta( $post->ID, '_car_external_link', true );

wp_nonce_field( 'save_car_details', 'car_details_nonce' );
?>
<style>
	.car-field { margin-bottom: 12px; }
	.car-field label { display: block; font-weight: 600; margin-bottom: 4px; }
	.car-field input { width: 100%; max-width: 400px; }
</style>

<div class="car-field">
	<label for="car_price"><?php _e( 'Price', $this->plugin_name ); ?></label>
	<input type="text" id="car_price" name="car_price" value="<?php echo esc_attr( $price ); ?>" placeholder="e.g., 8,50,000 INR" />
</div>

<div class="car-field">
	<label for="car_external_link"><?php _e( 'External Link', $this->plugin_name ); ?></label>
	<input type="url" id="car_external_link" name="car_external_link" value="<?php echo esc_url( $link ); ?>" placeholder="https://example.com/car-details" />
</div>
<?php