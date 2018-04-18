$(document).ready(function(){
    
    const page = $("html, body");
    const up = $('#up');
    const speedAnimate = 'slow';

    $('#menu').on('click','a', function (event) {
        
        event.preventDefault();
        const id  = $(this).attr('href'),
            top = $(id).offset().top - $('div.block-header').height();
        $(page).animate({scrollTop: top}, 500);

        return false;
    });

    $(window).scroll(function () {
        
        if ($(this).scrollTop() > 100) {
            up.show(speedAnimate);
        }else{
            up.hide(speedAnimate);
        }

        return false;
    });

    up.click(function(e) {

       page.on("scroll mousedown wheel DOMMouseScroll mousewheel keyup touchmove", function(){
           page.stop();
       });

       page.animate({ scrollTop: 0 }, speedAnimate, function(){
           page.off("scroll mousedown wheel DOMMouseScroll mousewheel keyup touchmove");
       });

       return false; 
    });

})