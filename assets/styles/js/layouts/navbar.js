

$(document).ready(function() {
    $('.nav-trigger').click(function() {
        $(this).toggleClass('active');
        $('.nav-list').toggleClass('show-list').fadeIn();
    });

    $(window).scroll(function() {
        if ($(document).scrollTop() > 50) {
            $('.nav').addClass('nav-scroll');
        } else {
            $('.nav').removeClass('nav-scroll');
        }
    });
})