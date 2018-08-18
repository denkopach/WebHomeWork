$(function(){
	let id = 0;
	
	$('.main').dblclick(function(e){
		let bubbles = $('.bubble-ready');
		let bubble = e.target;
		if (e.target.className.indexOf('bubble') + 1) {
			let text = e.target.innerText;
			e.target.innerText = '';
			let inputEl = $('<input/>');
			inputEl.addClass('signature')	
					.val(text)
					.appendTo(e.target)
					.focus()
			$(inputEl).keydown(function(e) {
				let inputText = inputEl.val();
				if (e.keyCode === 13 && checkInputTextLen(inputText)) {
					bubble.innerText = inputText;
					inputEl.remove();
					return;
				}
				if (e.keyCode === 13 && checkInputTextLen(inputText)){
					bubble.remove();
					return;			
				}
				if (e.keyCode === 27) {
					bubble.innerText = text;
					inputEl.remove();
					return;
				}
			})
		} else {
			let inputEl = $('<input/>');
			let bubble = $('<div/>');
			inputEl.addClass('signature')
				.appendTo(bubble
					.addClass('bubble')
					.attr('id', id++)
					.css({top: e.offsetY - 40, left: e.offsetX - 8})
					.appendTo('.main').draggable()
				)
			inputEl.focus();
			$(inputEl).keydown(function(e) {
				if (e.keyCode === 27) {
					bubble.remove();
					return;
				}
				let inputText = inputEl.val();
				if (e.keyCode === 13 && checkInputTextLen(inputText)) {
					bubble.text(inputText);
					inputEl.remove();
					bubble.addClass('bubble-ready')
					return;
				}
				if (e.keyCode === 13 && checkInputTextLen(inputText)){
					bubble.remove();
					return;			
				}
			})
		}
	})
	function checkEnterKey(bubble, inputEl) {
		$(inputEl).keydown(function(e) {
			if (e.keyCode === 27) {
				bubble.remove();
				return;
			}
			let inputText = inputEl.val();
			if (e.keyCode === 13 && checkInputTextLen(inputText)) {
				bubble.innerText = inputText;
				inputEl.remove();
				return;
			}
			if (e.keyCode === 13 && checkInputTextLen(inputText)){
				bubble.remove();
				return;			
			}
		})
	}
	function checkInputTextLen(text) {
		return text.length > 2;
	}
})