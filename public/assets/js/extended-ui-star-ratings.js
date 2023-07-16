/**
 * Star Ratings (jquery)
 */

'use strict';
$(function() {
    var basicRatings = $('.basic-ratings'),
        customSvg = $('.custom-svg-ratings'),
        multiColor = $('.multi-color-ratings'),
        halfStar = $('.half-star-ratings'),
        fullStar = $('.full-star-ratings'),
        readOnlyRatings = $('.read-only-ratings'),
        onSetEvents = $('.onset-event-ratings'),
        onChangeEvents = $('.onChange-event-ratings'),
        ratingMethods = $('.methods-ratings'),
        initializeRatings = $('.btn-initialize'),
        destroyRatings = $('.btn-destroy'),
        getRatings = $('.btn-get-rating'),
        setRatings = $('.btn-set-rating');

    // Basic Ratings
    // --------------------------------------------------------------------
    if (basicRatings) {
        basicRatings.rateYo({
            rating: 3.6,
            rtl: isRtl,
            spacing: '8px'
        });
    }

    // Custom SVG Ratings
    // --------------------------------------------------------------------
    if (customSvg) {
        customSvg.rateYo({
            rating: 3.2,
            starSvg: "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'>" +
                "<path d='M12 6.76l1.379 4.246h4.465l-3.612 2.625 1.379" +
                ' 4.246-3.611-2.625-3.612 2.625' +
                ' 1.379-4.246-3.612-2.625h4.465l1.38-4.246zm0-6.472l-2.833' +
                ' 8.718h-9.167l7.416 5.389-2.833 8.718 7.417-5.388' +
                ' 7.416 5.388-2.833-8.718' +
                " 7.417-5.389h-9.167l-2.833-8.718z'-></path>",
            rtl: isRtl,
            spacing: '8px'
        });
    }

    // Multi Color Ratings
    // --------------------------------------------------------------------
    if (multiColor) {
        multiColor.rateYo({
            rtl: isRtl,
            spacing: '8px',
            multiColor: {
                startColor: '#fffca0',
                endColor: '#ffd950'
            }
        });
    }

    // Half Star Ratings
    // --------------------------------------------------------------------
    if (halfStar) {
        halfStar.rateYo({
            rtl: isRtl,
            spacing: '8px',

            rating: 2
        });
    }

    // Full Star Ratings
    // --------------------------------------------------------------------
    if (fullStar) {
        fullStar.rateYo({
            rtl: isRtl,
            spacing: '8px',

            rating: 2
        });
    }

    // Read Only Ratings
    // --------------------------------------------------------------------
    if (readOnlyRatings) {
        readOnlyRatings.rateYo({
            rating: 2,
            rtl: isRtl,
            spacing: '5px',
            starSvg: '<svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z" fill-rule="nonzero"/></svg>'
        });
    }

    // Ratings Events
    // --------------------------------------------------------------------

    // onSet Event
    if (onSetEvents) {
        onSetEvents
            .rateYo({
                rtl: isRtl,
                spacing: '8px'
            })
            .on('rateyo.set', function(e, data) {
                alert('The rating is set to ' + data.rating + '!');
            });
    }

    // onChange Event
    if (onChangeEvents) {
        onChangeEvents
            .rateYo({
                rtl: isRtl,
                spacing: '8px'
            })
            .on('rateyo.change', function(e, data) {
                var rating = data.rating;
                $(this).parent().find('.counter').text(rating);
            });
    }

    // Ratings Methods
    // --------------------------------------------------------------------
    if (ratingMethods) {
        var $instance = ratingMethods.rateYo({
            rtl: isRtl,
            spacing: '8px'
        });

        if (initializeRatings) {
            initializeRatings.on('click', function() {
                $instance.rateYo({
                    rtl: isRtl,
                    spacing: '8px'
                });
            });
        }

        if (destroyRatings) {
            destroyRatings.on('click', function() {
                if ($instance.hasClass('jq-ry-container')) {
                    $instance.rateYo('destroy');
                } else {
                    window.alert('Please Initialize Ratings First');
                }
            });
        }

        if (getRatings) {
            getRatings.on('click', function() {
                if ($instance.hasClass('jq-ry-container')) {
                    var rating = $instance.rateYo('rating');
                    window.alert('Current Ratings are ' + rating);
                } else {
                    window.alert('Please Initialize Ratings First');
                }
            });
        }

        if (setRatings) {
            setRatings.on('click', function() {
                if ($instance.hasClass('jq-ry-container')) {
                    $instance.rateYo('rating', 1);
                } else {
                    window.alert('Please Initialize Ratings First');
                }
            });
        }
    }
});