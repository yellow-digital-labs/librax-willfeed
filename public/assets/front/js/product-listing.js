$(function(){
    const dynamicSlider = document.getElementById('delivery-time-range');
    const priceRangeSlider = document.getElementById('price-range');

    if(priceRangeSlider){
        noUiSlider.create(priceRangeSlider, {
            start: [price_min, price_max],
            connect: true,
            step: 0.1,
            direction: 'ltr',
            behaviour: 'tap-drag',
            tooltips: true,
            range: {
              min: 0.10,
              max: 10.00
            }
        });

        priceRangeSlider.noUiSlider.on('change', function (values, handle) {
            $("#price_min").val(values[0]);
            $("#price_max").val(values[1]);

            $("#product-form").submit();
        });
    }

    if (dynamicSlider) {
        noUiSlider.create(dynamicSlider, {
            start: [delivery_time_min, delivery_time_max],
            connect: true,
            step: 1,
            direction: 'ltr',
            behaviour: 'tap-drag',
            tooltips: true,
            range: {
              min: 0,
              max: 30
            }
        });

        dynamicSlider.noUiSlider.on('change', function (values, handle) {
            $("#delivery_time_min").val(values[0]);
            $("#delivery_time_max").val(values[1]);

            $("#product-form").submit();
        });
    }

    $(".product-filter-checkbox").on("change", function(){
        $("#product-form").submit();
    });
});