$(document).ready(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $("#scrolltop").fadeIn();
        } else {
            $("#scrolltop").fadeOut();
        }
    });
    $("#scrolltop img").click(function() {
        $("#scrolltop img").tooltip('hide');
        $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
    });
});
