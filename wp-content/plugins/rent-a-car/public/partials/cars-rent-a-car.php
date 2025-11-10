<?php
/**
 * Public-facing view for [rent_a_car_slider] shortcode.
 *
 * @package Rent_A_Car/public/partials
 */
?>

<div class="rent-a-car-container">
	<div class="rent-a-car-filter">
		<label for="brand-filter">Filter by Brand:</label>
		<select id="brand-filter">
			<option value="">All Brands</option>
			<?php
			$brands = get_terms( array(
				'taxonomy'   => 'brand',
				'hide_empty' => true,
			) );
			foreach ( $brands as $brand ) {
				echo '<option value="' . esc_attr( $brand->slug ) . '">' . esc_html( $brand->name ) . '</option>';
			}
			?>
		</select>
	</div>

	<div class="swiper rent-a-car-swiper">
		<div class="swiper-wrapper" id="cars-slider">
			<!-- Cars will be loaded here via REST API -->
		</div>

		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
		<div class="swiper-pagination"></div>
	</div>
	<div id="rent-a-car-message" class="rent-a-car-message"></div>

</div>
