const API_URL = 'https://picsum.photos/';
const BIG_SIZE = '600/400';
const SMALL_SIZE = '60';
const LEFT_ARROW = 37;
const RIGHT_ARROW = 39;

const IMAGES = [
    '?image=1080',
    '?image=1079',
    '?image=1069',
    '?image=1063',
    '?image=1050',
    '?image=1039'
];

const previewElements = $('#slider-previews');
const mainImg = $('.slider-current > img');

$(function () {

    previewElements.html(IMAGES.reduce(function (data, current) {
        return data + `
           <li class="preview-elem">
                <a href="" class="preview-link">
                    <img 
                    src="${API_URL}${SMALL_SIZE}${current}" 
                    class="preview-image">
                </a>
            </li>`;
    }, ''));

    $('li.preview-elem').first().addClass('current');

    $('a.preview-link').on('click', function (e) {
        $('ul > li').removeClass('current');
        e.preventDefault();
        mainImg.attr('src', $(e.target).attr('src').replace(SMALL_SIZE, BIG_SIZE));
        $(this).parent('li.preview-elem').addClass('current');
    });

    $(document).keydown(function (e) {
        switch (e.keyCode) {
            case LEFT_ARROW :
                selectSlide('prev');
                break;
            case RIGHT_ARROW:
                selectSlide('next');
                break;
        }
    })
});

function selectSlide(side) {
    const current = $(previewElements).find('li.current');
    const preview_elem = $('li.preview-elem');

    if (side === 'next') {
        const next = current.index() === preview_elem.length - 1 ?
            preview_elem.first() : current.next('li.preview-elem');
        next.addClass('current');
        mainImg.attr('src', next.find('img').attr('src').replace(SMALL_SIZE, BIG_SIZE));
    } else {
        const prev = current.index() === 0 ? preview_elem.last() : current.prev('li.preview-elem');
        prev.addClass('current');
        mainImg.attr('src', prev.find('img').attr('src').replace(SMALL_SIZE, BIG_SIZE));
    }
    current.removeClass('current');
}