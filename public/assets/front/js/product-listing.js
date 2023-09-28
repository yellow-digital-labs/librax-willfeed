$(function(){
    const dynamicSlider = document.getElementById('delivery-time-range');
    const priceRangeSlider = document.getElementById('price-range');

    if(priceRangeSlider){
        noUiSlider.create(priceRangeSlider, {
            start: [0.10, 10.00],
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

        priceRangeSlider.noUiSlider.on('update', function (values, handle) {
            $("#price_min").val(values[0]);
            $("#price_max").val(values[1]);
        });
    }

    if (dynamicSlider) {
        noUiSlider.create(dynamicSlider, {
            start: [0, 30],
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

        dynamicSlider.noUiSlider.on('update', function (values, handle) {
            $("#delivery_time_min").val(values[0]);
            $("#delivery_time_max").val(values[1]);
        });
    }

    $(".product-filter-checkbox").on("change", function(){
        $("#product-form").submit();
    });
});