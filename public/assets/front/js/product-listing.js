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
            const value = values[handle];
      
            // if (handle) {
            //   sliderInput.value = value;
            // } else {
            //   sliderSelect.value = Math.round(value);
            // }
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
            const value = values[handle];
      
            // if (handle) {
            //   sliderInput.value = value;
            // } else {
            //   sliderSelect.value = Math.round(value);
            // }
        });
    }
});