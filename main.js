const myOffcanvas = new bootstrap.Offcanvas('#offcanvasNavbar');

document.querySelector("#home-anchor-btn").onclick = function () {
    myOffcanvas.toggle();
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#home").offset().top
    }, 500);
}
document.querySelector("#about-anchor-btn").onclick = function () {
    myOffcanvas.toggle();
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#about").offset().top
    }, 500);
}
document.querySelector("#listings-anchor-btn").onclick = function () {
    myOffcanvas.toggle();
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#listings").offset().top
    }, 500);
}
document.querySelector("#contact-anchor-btn").onclick = function () {
    myOffcanvas.toggle();
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#contact").offset().top
    }, 500);
}