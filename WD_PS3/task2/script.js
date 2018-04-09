$(document).ready(function(){
    $("#menu").on("click","a", function (event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top - $("div.block-header").height();
        $('body,html').animate({scrollTop: top}, 500);
    });
    
    $('#up').on("click", function() {
        $('body, html').animate({scrollTop: 0},500);
        return false;
    });
})

