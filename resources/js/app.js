import "./libs/PageScroll2id"
import LazyLoad from "vanilla-lazyload";

$(window).on("load", function () {
    /* Page Scroll to id fn call */
    $("#navigation-menu a,a[href='#top'],a[rel='m_PageScroll2id']").mPageScroll2id({
        highlightSelector: "#navigation-menu a"
    });
});

window.onload = function () {
    $('.view-load').fadeOut(1000);
    animateCSS('.project-catalog li a.active', 'bounceIn')
    scrollToTop();
    lazyLoadInstance();
};

function lazyLoadInstance() {
    new LazyLoad({
        // Your custom settings go here
    });
}

function scrollToTop() {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    // scroll body to 0px on click
    $('#back-to-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 400);
        return false;
    });
}

window.animateCSS = (element, animation, prefix = 'animate__') =>
    // We create a Promise and return it
    new Promise((resolve, reject) => {
        const animationName = `${prefix}${animation}`;
        const node = document.querySelector(element);

        node.classList.add(`${prefix}animated`, animationName);

        // When the animation ends, we clean the classes and resolve the Promise
        function handleAnimationEnd(event) {
            event.stopPropagation();
            node.classList.remove(`${prefix}animated`, animationName);
            resolve('Animation ended');
        }

        node.addEventListener('animationend', handleAnimationEnd, { once: true });
    });

