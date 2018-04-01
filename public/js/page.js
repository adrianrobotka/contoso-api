// Load Page
$(function () {

    StickFooter();

    $(window).resize(function () {
        StickFooter();
    });
});

function StickFooter() {
    var full = $(document).height();
    var page = $("html").height() + 50;

    if (full <= page) {
        $("#pageFooter").removeClass("navbar-fixed-bottom");
    }
    else {
        $("#pageFooter").addClass("navbar-fixed-bottom");
    }
}
