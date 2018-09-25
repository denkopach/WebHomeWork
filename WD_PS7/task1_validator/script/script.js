$(function(){
	const pattern = {
		ip: 	/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/,
		url: 	/^(https?|ftp|torrent|image|irc):\/\/(-\.)?([^\s\/?\.#-]+\.?)+(\/[^\s]*)?$/i,
		email: 	/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
		date: 	/^(0[1-9]|1[012])[/](0[1-9]|[12][0-9]|3[01])[/]([0-1][1-9]|20)\d\d$/,
		time: 	/^([0-1][0-9]|2[0-3])[:]([0-5][0-9])[:]([0-5][0-9])$/
	};
	const $form = $('form');
	$form.on("input", "input", function(e) {
		const nameChangeEl = e.target.name;
		const input = $(`input[name='${nameChangeEl}']`);

		input.removeClass()
			.addClass(
				pattern[nameChangeEl]
					.test(input.val()) ? 'valid' : 'novalid'
				);
	});

	$form.submit(function () {
		const dataArr = $(this).serialize();

		$.ajax({
			url: "./php/app.php",
			method: "POST",
			data: dataArr,
			dataType: "json",
			success: function (response) {
				for (let i in response) {
					const validate = (response[i]) ? 'valid' : 'novalid';
					$(`span[id='${i}-result']`)
						.text(validate);
				}				
			}
		})
	});
});


