/**
 * Created by chief on 25.06.18.
 */
$(function () {
    const radio=$('input[type=radio]');
    $('.submit-btn').on('click', function (e) {
        e.preventDefault();
        $('#poll-form').slideToggle(900, function () {
            $('#poll-form')[0].submit();
        });
    });

    radio.first().attr('checked',true);
    radio.first().parent().addClass('border-active');

    radio.on('click', function () {
        $('.border-active').removeClass('border-active');
        $(this).parent().toggleClass('border-active');
    });
});