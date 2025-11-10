(function($) {
    'use strict';

    // console.log("rent-a-car-public.js loaded");

    function renderCars(cars) {
        // console.log("Cars received:", cars);
        const container = $('#cars-slider');
        container.empty();

        if (!cars.length) {
            container.append('<p>No cars found.</p>');
            return;
        }
        const defaultImage = `${rentACarData.pluginUrl}images/no-image.jpg`;

        cars.forEach(car => {
            container.append(`
                <div class="swiper-slide">
                    <div class="car-card">
                        <h3>${car.title}</h3>
                        <img src="${car.image || defaultImage}" alt="${car.title}" />
                        <p>${car.excerpt} </p>
                        <p><strong>Brand:</strong> ${car.brand?.join(', ') || 'N/A'}</p>
                        <p><strong>Price:</strong> ${car.price || 'N/A'}</p>
                        <p><a href="${car.external_link || '#'}" target="_blank">External Link</a></p>
                        <a href="${car.link}" class="details-btn">More Details</a>
                    </div>
                </div>
            `);
        });

        new Swiper('.rent-a-car-swiper', {
            slidesPerView: 3,
            spaceBetween: 20,
            pagination: { el: '.swiper-pagination', clickable: true },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
            breakpoints: {
                768: { slidesPerView: 3 },
                480: { slidesPerView: 1 },
            },
        });
    }

    function fetchCars(brand = '') {
        const container = $('#cars-slider');
        const messageBox = $('#rent-a-car-message');
        let url = rentACarData.restUrl;
        if (brand) url += `?brand=${encodeURIComponent(brand)}`;

        // console.log("Fetching:", url);

        // Show spinner
        container.html(`
            <div class="loading">
                <div class="spinner"></div>
                <p>Loading cars...</p>
            </div>
        `);
        messageBox.text('');

        $.ajax({
            url: url,
            method: 'GET',
            timeout: 8000, // 8s timeout
        })
        .done(cars => {
            // console.log("Cars received:", cars);

            if (!cars || cars.length === 0) {
                container.html('<div class="no-cars">No cars found for this brand.</div>');
                return;
            }

            renderCars(cars);
        })
        .fail((xhr, status) => {
            // console.error("Error fetching cars:", status);

            let errorMsg = 'Something went wrong while loading cars.';
            if (status === 'timeout') {
                errorMsg = 'Request timed out. Please try again.';
            }

            container.html(`
                <div class="error">
                    <p>${errorMsg}</p>
                    <button id="retry-btn" class="retry-btn">Retry</button>
                </div>
            `);

            // Retry handler
            $('#retry-btn').on('click', function () {
                fetchCars(brand);
            });
        });
    }

    $(function() {
        // console.log("DOM ready");
        fetchCars();

        $('#brand-filter').on('change', function() {
            const selected = $(this).val();
            fetchCars(selected);
        });
    });

})(jQuery);
