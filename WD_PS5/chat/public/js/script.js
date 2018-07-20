$(document).ready(function(){
	updChat();
	setInterval(updChat, 1000);

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
		if (!chatArr) {
			return;
		}
		chatBlock = chatBlock.empty();
		var size = Object.keys(chatArr).length;
		for (var key in chatArr){
			let val = chatArr[key];
			let msgTmp = escapeHtml(val.msg)
					.replace(':)','<img src = "icons/smile.png">')
					.replace(':(','<img src = "icons/sad.png">');
			var date = new Date(val.time*1000);
			var time = [date.getHours(), date.getMinutes(), date.getSeconds()].map(function (x) {
						return x < 10 ? "0" + x : x
						}).join(":")			
			const msg = `<p>[${time}] ${val.name}: ${msgTmp}</p>`;
			chatBlock.append(msg);
		};

		chatBlock.scrollTop(chatBlock.prop('scrollHeight'));
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
	};

	function escapeHtml(text) {
		return text
			.replace(/&/g, "&amp;")
			.replace(/</g, "&lt;")
			.replace(/>/g, "&gt;")
			.replace(/"/g, "&quot;")
			.replace(/'/g, "&#039;");
	}
});