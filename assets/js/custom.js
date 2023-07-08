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