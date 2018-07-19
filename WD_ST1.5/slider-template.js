const API_URL = 'https://picsum.photos/';
const BIG_SIZE = '600/400';
const SMALL_SIZE = '60';

const IMAGES = [
  '?image=1080', 
  '?image=1079', 
  '?image=1069', 
  '?image=1063', 
  '?image=1050',
  '?image=1039'
];

$.each(IMAGES, function (index, value) {
	const imgEl = `<li><img src="${API_URL + BIG_SIZE + '/' + value}" alt="0" class="slider-img"></li>`;
	$('.slider-previews').append(imgEl);
});

const sliderPrewLi = $('.slider-previews li');
sliderPrewLi.first().addClass('current');
sliderPrewLi.hover(
	function(){
		$(this).addClass('liFocus');
	},
	function(){
		$(this).removeClass('liFocus');
	}
);

sliderPrewLi.click(function(){
	sliderPrewLi.each(function (index, value) {
		$(value).removeClass('current');
	});
	if ($(event.target).is('.slider-img')){
		$(this).addClass('current');
	};
	
	const currentImg = $(event.target).attr('src');
	$('.slider-current img').attr('src', currentImg);
});

$(document).keydown(function(event) {
	let current = $('li').index($('.current'));

	switch (event.keyCode) {
		case 37: //left button
			changeCurrentImg(current, -1);
			break;
		case 39: //right button
			changeCurrentImg(current, 1);
			break;
	} 
});

function changeCurrentImg(current, next) {
	const itemCount = IMAGES.length;
	let nextCurrent = current + next;
	if (nextCurrent >= itemCount) {
		nextCurrent = 0;
	} else if (nextCurrent < 0) {
		nextCurrent = itemCount - 1;
	}
	$(`li:eq(${current})`).removeClass('current');
	$(`li:eq(${nextCurrent})`).addClass('current');
	const currentImg = $(`li:eq(${nextCurrent}) img`).attr('src');
	$('.slider-current img').attr('src', currentImg);
}