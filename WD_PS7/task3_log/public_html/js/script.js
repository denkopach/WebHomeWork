$(function(){

	const IS_LOGGING = true;
	let currentId = 0;

	updChat();
	setInterval(updChat, 1000);

	function logging(obj) {	
		if (IS_LOGGING) {
            console.log(obj);
        }
	}
    $(".formChat").submit(function () {
        event.preventDefault();
        addMsg();
    });
	function updChat() {
		ajax({updChat: true, lastId: currentId})
			.done(function (response) {
				try {
					response = JSON.parse(response);
					logging(response['log']);
					if (response['data']){
						addMsgInChat(response['data']);
					}
				} catch(err) {
					logging(err);
				}
			}).fail(function(response) {
				try {
					response = JSON.parse(response);
					logging(response['log']);
				} catch(err) {
					logging(err);
				}
			});
	}
	const chatBlock = $('.block-msg-windows');
	function addMsgInChat(chatArr) {
		chatArr.forEach(function(element) {
			const date = new Date(element.msgTime);
			const time = [date.getHours(), date.getMinutes(), date.getSeconds()].map(function (dateItem ) {
				return dateItem < 10 ? "0" + dateItem : dateItem;
				}).join(":");
			if (currentId < element.msgId) {
				let msg = element.msgText
						.replace(':)','<img src = "images/smile.png">')
						.replace(':(','<img src = "images/sad.png">');
				msg = `<p>[${time}] ${element.userName}: ${msg}</p>`;
				chatBlock.append(msg);
				currentId = element.msgId;
				chatBlock.scrollTop(chatBlock.prop('scrollHeight'));
			}
		});
	}
	const chat = $('.block-chat');
    chat.on('click', '.btmMsg', function() {
		addMsgInChat();
	});

    const inputEl = $('.userMsg');
    inputEl.keypress(function (event) {
		if (event.which === '13') {
			event.preventDefault();
		}
	});

	function addMsg() {
		const msg = inputEl.val();
		inputEl.val('');
		if(msg.length){
			ajax({userMsg: msg,	btnMsg: 'send'})
				.done(function(response) {
					try {
						response = JSON.parse(response);
						logging(response.log);
					} catch (err) {
						logging(err);
					}
				}).fail(function(response) {
					try {
						response = JSON.parse(response);
						logging(response['log']);
					} catch (err) {
						logging(err);
					}

				});
		}
		updChat();
	}

    chat.on('click', '.exit-btn', function() {
		ajax({btnExt: true})
			.done(function(response) {
				logging( JSON.parse(response));
			}).fail(function(response){
				logging( JSON.parse(response));
			});
		location.reload(true);
	});

	function ajax(data) {
		return $.ajax({
			type: "POST",
			url: 'postRedirectGet.php',
			data: data,
		}); 
	}
});