/**
 * Created by chief on 24.04.18.
 */
const scrollTrigger = 100;
const scrollSpeed = 400;
const page = $('html,body');
let active = false;

$(function () {
    const upBtn = $('.up-btn');
    $('.links>a').click(function (e) {
        e.preventDefault();
        scroll(this.id);
    });

    page.on('wheel DOMMouseScroll mousewheel', function () {
        page.stop(true, false);
        active = false;
    });

    $(window).scroll(function () {
        $(this).scrollTop() > scrollTrigger ? upBtn.fadeIn() : upBtn.fadeOut();
    });

    upBtn.on('click', function (e) {
        e.preventDefault();
        if (!active) {
            active = true;
            page.animate({scrollTop: 0}, scrollSpeed, function () {
                active = false;
            });
        }
    });
});
function showInfo() {
    const btn = $('#extra-inputs-btn');
    $('#example-inputs').toggle(scrollSpeed);
    btn.text(btn.text() == 'More inputs' ? 'Less inputs' : 'More inputs');
}

function scroll(id) {
    if (!active) {
        active=true;
        id = id.replace('-link', '');
        const el = $('#' + id);
        const elOffset = el.offset().top;
        const elHeight = el.height();
        const windowHeight = $(window).height();
        const offset = elHeight < windowHeight ? elOffset - ((windowHeight / 2) - (elHeight / 2)) : elOffset;
        page.stop(true, false).animate({scrollTop: offset}, 4000,function () {
            active=false;
        });
    }
}