const MIN_LEN = 1;
const ENTER_KEY = 13
const ESC_KEY = 27
const TOP_INDENTATION = 40
const LEFT_INDENTATION = 8

let id = 0;

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

function editMsg(bubble, inputText, key = ENTER_KEY){
	if (key === ENTER_KEY && checkInputTextLen(inputText)) {
		$(bubble).text(inputText)
			.addClass('bubble-ready')
			.find('input').remove()
		determineShift(bubble)
		updMsg(bubble)
	} else if (key === ENTER_KEY && !checkInputTextLen(inputText)){
		bubble.isDel = 1
		updMsg(bubble)
		$(bubble).empty().remove();
	} else if (key === ESC_KEY) {
		$(bubble).text(inputText)
		$(bubble).find('input').remove();
	}
	return;
}

function updMsg(obj) {
	if (!obj.isDel || obj.isDel === null) {
		obj.isDel = 0;
	}
	$.ajax({
		url: "php/app.php",
		method: "POST",
		data: {
			msg: $(obj).text(),
			id: $(obj).attr('id'),
			offsetX: $(obj).offset().left + 8,
			offsetY: $(obj).offset().top + 40,
			isDel: obj.isDel,
		},
	})
}

function getAllMsg() {
	$.ajax({
		url: "php/app.php",
		method: "POST",
		dataType: "json",
		data: {
			getAllMsg: true,
		},
	}).done(function (res) {
		for (let i in res) {
			addBubble(res[i])
			id = Number(res[i].id) + 1;
		}
	})
}
function createBubble(obj) {
	return $('<div/>')
		.addClass('bubble')
		.attr('id', id)
		.css({top: obj.offsetY - TOP_INDENTATION, left: obj.offsetX - LEFT_INDENTATION})
		.appendTo('.main')
		.draggable({
			containment: 'parent' 
		})
}
function addBubble(obj) {
	const bubble = createBubble(obj)
	$(bubble).text(obj.msg)
		.addClass('bubble-ready')
}

$(function(){
	getAllMsg();
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
					editMsg(bubble, $(this).val(), ENTER_KEY)
				})
				.keydown(function(e) {
					editMsg(bubble, $(this).val(), e.keyCode)
				})
		} else {
			const inputEl = $('<input/>');
			const bubble = createBubble(e)
			bubble.isDel = 0
			id++
			inputEl.addClass('signature')
				.appendTo(bubble)
				.focus()
				.keydown(function(e) {
					if (e.keyCode === ESC_KEY) {
						bubble.remove();
						return
					}
					editMsg(bubble, $(this).val(), e.keyCode);
				})
				.blur(function() {
					editMsg(bubble, $(this).val(), ENTER_KEY);
				})

		}
	})
	// $('.bubble').mouseup(function() {
	// 	editMsg($(this), $(this).textContent(), e.keyCode)
	// })
	$(".main").droppable({
		// drop: function(event, ui) {
		// 	console.log($(ui.draggable).text())
		// }
		drop: function(event, ui) {
			editMsg(ui.draggable, $(ui.draggable).text())
		}
	});
})