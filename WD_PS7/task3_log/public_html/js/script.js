$(function(){

	const IS_LOGGING = true;
	let currentId = 0;

	updChat();
	setInterval(updChat, 1000);

	function logging(obj) {	
		console.log(obj);
	}

	function updChat() {
		ajax({updChat: true, lastId: currentId})
			.done(function (responce) {
				try {
					responce = JSON.parse(responce);
					logging(responce['log']);
					if (responce['data']){
						addMsgInChat(responce['data']);
					}
				} catch(err) {
					logging(err);
				}
			}).fail(function(responce) {
				try {
					responce = JSON.parse(responce);
					logging(responce['log']);
				} catch(err) {
					logging(err);
				}
			});
	}
	const chatBlock = $('.block-msg-windows');
	function addMsgInChat(chatArr) {
		chatArr.forEach(function(element) {
			const date = new Date(element.time);
			const time = [date.getHours(), date.getMinutes(), date.getSeconds()].map(function (dateItem ) {
				return dateItem < 10 ? "0" + dateItem : dateItem;
				}).join(":");
			if (currentId < element.newid) {
				let msg = element.msg
						.replace(':)','<img src = "images/smile.png">')
						.replace(':(','<img src = "images/sad.png">');
				msg = `<p>[${time}] ${element.name}: ${msg}</p>`;
				chatBlock.append(msg);
				currentId = element.newid;
				chatBlock.scrollTop(chatBlock.prop('scrollHeight'));
			}
		});
	}

	$('.block-chat').on('click', '.btmMsg', function() {
		addMsgInChat();
	})

	$('.formChat').keypress(function (event) {
		if (event.which === '13') {
			event.preventDefault();
			addMsg();
		}
	})

	$('.send-message-btn').click(function(){
		addMsg();
	})

	const inputEl = $('.userMsg');
	function addMsg() {
		const msg = inputEl.val();
		inputEl.val('');
		if(msg.length > 0){
			ajax({userMsg: msg,	btnMsg: 'send'})
				.done(function(responce) {
					try {
						responce = JSON.parse(responce);
						logging(responce.log);
					} catch (err) {
						logging(err);
					}
				}).fail(function(responce) {
					try {
						responce = JSON.parse(responce);
						logging(responce['log']);
					} catch (err) {
						logging(err);
					}

				});
		}
		updChat();
	}

	$('.block-chat').on('click', '.exit-btn', function() {
		ajax({btnExt: true})
			.done(function(responce) {
				logging( JSON.parse(responce));
			}).fail(function(responce){
				logging( JSON.parse(responce));
			});
		location.reload(true);
	})

	function ajax(data) {
		return $.ajax({
			type: "POST",
			url: 'postRedirectGet.php',
			data: data,
		}); 
	}
})