const myOffcanvas = new bootstrap.Offcanvas('#offcanvasNavbar');

document.querySelector("#home-anchor-btn").onclick = function () {
    if($(window).width() <= 991){
        myOffcanvas.toggle();
    }
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#home").offset().top
    }, 500);
}
document.querySelector("#about-anchor-btn").onclick = function () {
    if($(window).width() <= 991){
        myOffcanvas.toggle();
    }
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#about").offset().top
    }, 500);
}
document.querySelector("#explore-anchor-btn").onclick = function () {
    if($(window).width() <= 991){
        myOffcanvas.toggle();
    }
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#explore").offset().top
    }, 500);
}
document.querySelector("#contact-anchor-btn").onclick = function () {
    if($(window).width() <= 991){
        myOffcanvas.toggle();
    }
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#contact").offset().top
    }, 500);
}