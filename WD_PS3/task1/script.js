$(document).ready(function() {
	addList();

	const dropdownListEl = $('.dropdown_list');
	const enterItemEl = $('.enter_item');
	let clickCheck = false;

	$(document).on('click', function(event) {
		const targetEl = $(event.target);
		if(targetEl.is('li')){
			if(clickCheck){
				return false;
			}
			
			const findElActive = dropdownListEl.find('.item_active');

			clickCheck = true;

			dropdownListEl.slideToggle('fast', function(){
				clickCheck = false;
			});
			findElActive.removeClass('item_active');
			targetEl.addClass('item_active');

			if (!dropdownListEl.find('li').is('.item_active')){
				return;
			}

			enterItemEl.find('.item_active').remove();
			enterItemEl.append($('.dropdown_list').find('.item_active').clone());
		}else{
			dropdownListEl.hide('fast');
		}
	});

	$('.dropdown_list').on('mouseenter', 'li', function() {
		$(this).addClass('liFocus');
	});
	$('.dropdown_list').on('mouseleave', 'li', function() {
		$(this).removeClass('liFocus');	
	});

});

function getSelectText(){
	let res = $('#selected').find('li').text();
	if(res === 'Selected friends'){
		return false;
	}
	return res;
}

function addList(){
	const friendsArr = [
		{name: 'Jenny Hess', img: 'alien'},
		{name: 'Elliot Fu', img: 'dracula'},
		{name: 'Stevie Feliciano', img: 'scream'},
		{name: 'Christian', img: 'skull'},
		{name: 'Matt', img: 'squash'}
	];
	
	friendsArr.forEach(function(friend){
		$('.dropdown_list').append($('<li></li>')
					.text(friend.name)
					.prepend($(`<img src="icons/${friend.img}.ico">`))
		);
	});
	
};