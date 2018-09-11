document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')

function checkValid(pattern, val) {
	return pattern.test(val)
}

$(function(){
	const pattern = {
		ip: 	/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/,
		url: 	/^(https?|ftp|torrent|image|irc):\/\/(-\.)?([^\s\/?\.#-]+\.?)+(\/[^\s]*)?$/i,
		email: 	/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
		date: 	/^(0[1-9]|1[012])[/](0[1-9]|[12][0-9]|3[01])[/](19|20)\d\d$/,
		time: 	/^([0-1][0-9]|2[0-3])[:]([0-5][0-9])[:]([0-5][0-9])$/
	}

	$('form').change(function(e) {
		const nameChangeEl = e.target.name;
		const valInput = $(`input[name='${nameChangeEl}']`).val();
		
		alert(`${nameChangeEl} is ${pattern[nameChangeEl].test(valInput)}`);
		/*isvalid = switch(nameChangeEl) {
			case 'ip': {
				return checkValid(pattern[nameChangeEl], valInput)
				break
			};
			case 'url': {
				return validateURLAddress(valInput)
				break
			};
			case 'email': {
				return validateEmailAddress(valInput)
				break
			}
			case 'date': {
				return validateDate(valInput)
				break
			}
			case 'time': {
				isValid = validateTime(valInput)
				break
			}
		}
		alert(`${nameChangeEl} ${isValid}`);*/
	})
})