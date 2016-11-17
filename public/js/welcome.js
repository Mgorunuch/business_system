$(document).ready(function() {

    //Chrome Smooth Scroll
    try {
        $.browserSelector();
        if($("html").hasClass("chrome")) {
            $.smoothScroll();
        }
    } catch(err) {

    };

    particlesJS.load('particles', '/js/particles/particlesjs-config.json', function() {
        console.log('callback - particles.js config loaded');
    });
});