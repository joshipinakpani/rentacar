=== Rent A Car ===
Contributors: pinakpani
Donate link: https://www.resmed.com/
Tags: car rental, slider, custom post type, rest api, filter, brand
Requires at least: 5.8
Tested up to: 6.7
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily display and manage rental cars with brand filters and a dynamic REST API–powered slider.

== Description ==

**Rent A Car** is a WordPress plugin that allows site owners to showcase cars available for rent using a responsive slider powered by the WP REST API and Swiper JS.  
It dynamically fetches car data, displays brand filters, includes title, price, image and detail links for each car.

### Key Features
* Custom Post Type for “Cars”
* Custom Taxonomy “Brand” for filtering
* REST API endpoint to fetch cars dynamically
* Responsive Swiper.js slider
* AJAX-based brand filter
* Secure meta fields for price and external link
* Auto page creation for `/products/cars/rent-a-car/`
* Graceful error handling with timeout and retry option

Perfect for car rental businesses, dealerships, or any listing of cars with modern UI and backend integration.

== Installation ==

1. Upload the `rent-a-car` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the **Plugins** menu in WordPress.
3. On activation, it will automatically create a page at `/products/cars/rent-a-car/`.
4. /products/cars/rent-a-car/ page content already contains `[rent_a_car_slider]` where the car slider works.

== Frequently Asked Questions ==

= How do I add cars? =
Go to **Cars → Add New** in the WordPress dashboard.  
You can set title, price, external link, excerpt, featured image and assign a brand.

= How can I filter cars by brand? =
The slider automatically displays a dropdown to filter cars by their assigned brand.

= What if no image is uploaded? =
The plugin displays a default "No Image" placeholder from the plugin’s image directory.

= Does it support REST API? =
Yes, the cars data is fetched dynamically from `/wp-json/rent-a-car/v1/cars`.


== Screenshots ==

1. Rent a Car Slider frontend with brand filter.
2. Car Custom Post Type editor with fields for price and external link.
3. Example REST API response in the browser.

**1. Rent a Car Slider**
![Rent a Car Slider](wp-content/plugins/rent-a-car/assets/screenshot-1.jpg)

**2. Admin Car Post Type**
![Admin CPT](wp-content/plugins/rent-a-car/assets/screenshot-2.jpg)

**3. REST API Response**
![REST API](wp-content/plugins/rent-a-car/assets/screenshot-3.jpg)


== Changelog ==

= 1.0.0 =
* Initial release
* Added custom post type “Cars” and taxonomy “Brand”
* Added REST API endpoint `/rent-a-car/v1/cars`
* Added `[rent_a_car_slider]` shortcode with Swiper.js slider
* Implemented timeout and retry for data fetch

== Upgrade Notice ==

= 1.0.0 =
Initial stable release of the Rent A Car plugin.

== Arbitrary section ==

### Shortcode Reference

Use the following shortcode anywhere on your site:
[rent_a_car_slider]


### REST API Endpoint
Fetch all cars data:
GET /wp-json/rent-a-car/v1/cars


Optional filter by brand:
GET /wp-json/rent-a-car/v1/cars?brand=audi

== Credits ==
Developed by Pinakpani Joshi
Email: joshipinakpani@gmail.com
GitHub: https://github.com/pinakpani

== Features Summary ==

| Feature | Description | Status |
|----------|--------------|--------|
|**Custom Post Type** | Adds a “Cars” post type to manage car listings. | ✅ |
|**Brand Taxonomy** | Categorize cars by brand (Audi, BMW, etc.) | ✅ |
|**REST API Endpoint** | Provides `/wp-json/rent-a-car/v1/cars` for fetching cars dynamically. | ✅ |
|**Brand Filter Dropdown** | Filter cars by brand using AJAX. | ✅ |
|**Responsive Swiper Slider** | Displays cars beautifully on all devices. | ✅ |
|**Price & Link Meta Fields** | Each car includes price and external link fields. | ✅ |
|**Auto Page Creation** | Automatically creates `/products/cars/rent-a-car/` page with shortcode [rent_a_car_slider] in content. | ✅ |
|**Timeout & Retry Handling** | Ensures API calls recover gracefully from errors. | ✅ |
|**Shortcode Support** | Use `[rent_a_car_slider]` anywhere on your site. | ✅ |
|**Developer Friendly** | Clean code, hooks, and extensible structure. | ✅ |