$(function(){
	$('form').submit(function (event) {
		const string = $('textarea[name="string"]').val();
		const pattern = $('input[name="regExp"]').val();

		var parts = /\/(.*)\/(.*)/.exec(pattern);
		
		try {
			var reg = new RegExp(parts[1], parts[2]);
			newString = string.replace(reg, function(p) {
				return `<mark>${p}</mark>`;
			})
			$('span[name="result"]').empty().append(newString);
		} catch(err) {
			const errMsg = 'ERROR! Invalid regular expression'
			$('span[name="result"]').empty().append(errMsg);
			console.log(err);
		}
	})
})