$(document).ready(function () {

    // scroll header
    var doc = document.documentElement;
    var w = window;
    var prevScroll = w.scrollY || doc.scrollTop;
    var curScroll;
    var direction = 0;
    var prevDirection = 0;
    var headerHeight = $('.header').outerHeight();

    var checkScroll = function () {
        curScroll = w.scrollY || doc.scrollTop;
        if (curScroll > prevScroll) {
            //scrolled up
            direction = 2;
        }
        else if (curScroll < prevScroll) {
            //scrolled down
            direction = 1;
        }
        if (direction !== prevDirection) {
            toggleHeader(direction, curScroll);
        }
        prevScroll = curScroll;
        if (curScroll == 0) {
            $('.header').css({ "box-shadow": "none" });
            $('#banner-carousel').css({ "margin-top": headerHeight + 'px' }); 
        } else {
            $('.header').css({ "box-shadow": "rgba(0, 0, 0, 0.25) 0px 3px 10px" });
        }
    };
    var toggleHeader = function (direction, curScroll) {
        if (direction === 2 && curScroll > headerHeight) {
            $('.header').addClass('hide-header');
            prevDirection = direction;
        }
        else if (direction === 1) {
            $('.header').removeClass('hide-header');
            prevDirection = direction;
        }
    };
    window.addEventListener('scroll', checkScroll);
    // scroll header end
});