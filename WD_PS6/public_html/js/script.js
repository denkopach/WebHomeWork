$(function(){
	updChat();
	setInterval(updChat, 1000);

	let currentId = '';

	function updChat() {
		$.ajax({
			type: "POST",
			url: 'postRedirectGet.php',
			data: {
				updChat: true,
			},	
			success(ressponce) {
				if (ressponce) {
					addMsgInChat(JSON.parse(ressponce));
				}	
			}
		});
	}

	function addMsgInChat(chatArr) {
		
		let chatBlock = $('.block-msg-windows');

		chatArr.forEach(function(element) {
			const date = new Date(element.time);
			const time = [date.getHours(), date.getMinutes(), date.getSeconds()].map(function (x) {
				return x < 10 ? "0" + x : x;
				}).join(":");
			if (+currentId < +element.newid) {
				let msg = element.msg
						.replace(':)','<img src = "images/smile.png">')
						.replace(':(','<img src = "images/sad.png">');
				msg = `<p>[${time}] ${element.name}: ${msg}</p>`;
				chatBlock.append(msg);
				currentId = element.newid;
				chatBlock.scrollTop(chatBlock.prop('scrollHeight'));
			}

			console.log(element.name);
		});
	}

	$(document).on('click', '.btmMsg', function() {
		addMsg();
	});

	$('.formChat').keypress(function (event) {
		if (event.which == '13') {
			event.preventDefault();
			addMsg();
		}
	});

	$('.btnMsg').click(function(){
		addMsg();
	});

	function addMsg() {
		let inputEl = $('.userMsg');
		const msg = inputEl.val();
		inputEl.val('');
		if(msg.length > 0){
			$.ajax({
				type: "POST",
				url: 'postRedirectGet.php',
				data: {
					userMsg: msg,
					btnMsg: 'send'
				}
			}); 
		}
		updChat();
	}
});