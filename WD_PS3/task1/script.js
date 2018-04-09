$(document).ready(function() {
	addList();

	$('.dropdown').on('click', 'ul', function(event) {
		const dropdownListEl = $('.dropdown_list');
		dropdownListEl.slideToggle('fast');
		
		const enterItemEl = $('.enter_item');	
		const targetEl = $(event.target);
		const findElActive = dropdownListEl.find('.item_active');

		findElActive.removeClass('item_active');
		targetEl.addClass('item_active');

		if (!dropdownListEl.find('li').is(".item_active")){
			return;
		}

		enterItemEl.find('.item_active').remove();
		enterItemEl.append($('.dropdown_list').find('.item_active').clone());
	});

	$('.dropdown_list').on('mouseenter', 'li', function() {
		$(this).addClass('liFocus');
	});
	$('.dropdown_list').on('mouseleave', 'li', function() {
		$(this).removeClass('liFocus');	
	});

});

function getSelectText(){
	var res = $('#selected').find('li').text();
	if(res === 'Selected friends'){
		return false;
	}
	return res;
}

function addList(){
	const nameArr = [
		['Jenny Hess', 'alien'],
		['Elliot Fu', 'dracula'],
		['Stevie Feliciano', 'scream'],
		['Christian', 'skull'],
		['Matt', 'squash']
	];
	nameArr.forEach(function(item){
		$('.dropdown_list').append($('<li></li>')
					.text(item[0])
					.prepend($(`<img src="icons/${item[1]}.ico" alt="">`))
		);
	});
};