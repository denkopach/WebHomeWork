const MIN_LEN = 1;
const ENTER_KEY = 13
const ESC_KEY = 27
const TOP_INDENTATION = 40
const LEFT_INDENTATION = 8


function checkInputTextLen(text) {
	return text.length >= MIN_LEN;
}

function determineShift(bubble) {
	let left = $(bubble).offset().left
	let top = $(bubble).offset().top
	const cont = $('.main')
	if (left + $(bubble).outerWidth(true) > cont.outerWidth(true)) {
		left = cont.outerWidth(true) - $(bubble).outerWidth(true)
	}
	if (top + TOP_INDENTATION - $(bubble).outerHeight() < 0) {
		top = $(bubble).outerHeight() - TOP_INDENTATION
	}
	$(bubble).offset({top: top, left: left}) 
}

function saveMsg(bubble, inputText, key = ENTER_KEY){
	if (key === ENTER_KEY && checkInputTextLen(inputText)) {
		$(bubble).text(inputText)
			.addClass('bubble-ready')
			.find('input').remove()
		determineShift(bubble)
	} else if (key === ENTER_KEY && !checkInputTextLen(inputText)){
		bubble.remove();
	} else if (key === ESC_KEY) {
		$(bubble).text(inputText)
		console.log(inputText)
		$(bubble).find('input').remove();
	}
	return;
}

$(function(){
	let id = 0;
	$('.main').dblclick(function(e){	
		const bubble = e.target;

		if (e.target.className.indexOf('bubble') + 1) {
			let text = e.target.textContent;
			e.target.textContent = '';
			$('<input/>').addClass('signature')	
				.val(text)
				.appendTo(e.target)
				.focus()
				.blur(function() {
					saveMsg(bubble, $(this).val(), ENTER_KEY);
				})
				.keydown(function(e) {
					saveMsg(bubble, $(this).val(), e.keyCode);
				})
		} else {
			const inputEl = $('<input/>');
			const bubble = createBubble(e)
			inputEl.addClass('signature')
				.appendTo(bubble)
				.focus()
				.keydown(function(e) {
					if (e.keyCode === ESC_KEY) {
						bubble.remove();
						return
					}
					saveMsg(bubble, $(this).val(), e.keyCode);
				})
				.blur(function() {
					saveMsg(bubble, $(this).val(), ENTER_KEY);
				})
		}
	})

function createBubble(e) {
	return $('<div/>')
		.addClass('bubble')
		.attr('id', id++)
		.css({top: e.offsetY - TOP_INDENTATION, left: e.offsetX - LEFT_INDENTATION})
		.appendTo('.main')
		.draggable({
			containment: 'parent' 
		})
}

})