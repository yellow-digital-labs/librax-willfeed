/* Sticky Menu */
var navbar = document.getElementById("header");
var navbarHt = $(navbar).height();
var sticky = 0;
if (navbar) {
    sticky = navbar.offsetTop;
}

function makeNavFixed() {
    if (navbar) {
        if (window.pageYOffset >= navbarHt) {
            navbar.classList.add("is-fixed");
        } else {
            navbar.classList.remove("is-fixed");
        }
    }
}

$(function () {
    makeNavFixed();
});
$(window).on('scroll', makeNavFixed);

$(function(){

    var screenWidth = $(window).innerWidth();

    if (screenWidth >= 768) {

        $('.js-header-toggler:not(.clicked)').on('click', function () {

            var sel = $(this);
            $(sel).addClass('clicked');

        });
    }

});

$('.js-header-toggler').on('click', function(e){
    var sel = $(this);

    var activeFlag = $(sel).hasClass('is-active');

    if(activeFlag){
       $('.js-header-collapse').hide();
        $('body').removeClass('is-header-active');
    }
    else {
        $('.js-header-collapse').fadeIn();
        $('body').addClass('is-header-active');
    }

    $(sel).toggleClass('is-active');
});


// Basic Ratings
// --------------------------------------------------------------------
if ($('.js-product-ratings').length > 0) {
    $('.js-product-ratings').each(function () {
        var sel = $(this);
        var currentRating = $(sel).attr('data-rating');
        $(sel).rateYo({
            rating: currentRating,
            spacing: '4px',
            ratedFill: "#000",
            normalFill: "#C6C6C6",
            readOnly: true,
            starWidth: "18px",
            starSvg: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">\
            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9998 17.748L5.82784 20.993L7.00684 14.12L2.00684 9.253L8.90684 8.253L11.9928 2L15.0788 8.253L21.9788 9.253L16.9788 14.12L18.1578 20.993L11.9998 17.748Z" fill="inherit"/>\
            </svg>'
        });
    });
}