const thousand = 1000;

$(function () {
	getWeather();

	$('nav').click(function(e) {
		event.preventDefault();
		getWeather($(e.target));
	})
})
function getSVG(icon, parrent) {
    $.get(`../img/icons/${icon}.svg`).done(function(result) {
		parrent.html($(result.documentElement).attr('fill', '#fff'));
	});
}
function convertDate(t) {
	let date = new Date(t * thousand);
	const options = {
		month: 'numeric',
		day: 'numeric',
		weekday: 'long',
	};
	return date.toLocaleString("en-US", options);
}
function TimeCounter(t) {
	const date = new Date(t * thousand);
	return `${("0" + date.getHours()).slice(-2)}:00`;
}

function getWeather(target) {

	if(target) {
		$('.active').removeClass('active');
		target.addClass('active');
		target = `getFrom${$(target).text()}`;
	} else {
		target = 'getFromJSON';
	}

    $.ajax({
        url: 'app/getWeather.php',
        dataType: "json",
        method: "POST",
        data: {
            getWeather: target,
        }
    }).done(function(res){
    	if (!res) {
    		throw 'ERROR data';
    	}
    	$('.forecast').empty();
    	$('.current-temperature').text(`${res[0].temperature} °`);
    	getSVG(res[0].icon, $('.weather-icon'));
    	const countItems = res.length;
		$('.date').text(convertDate(res[0].time));
    	for (let index = 1; index < countItems; index++) {
	    	const container = $('<div/>').addClass('hourly-forecast clearfix');
	    	const temperature = $('<div/>').addClass('forecast-temperature').text(`${res[index].temperature} °`);
	    	const icon = $('<div/>').addClass('forecast-icon');
	    	const weather = $('<div/>').addClass('forecast-weather');
	    	const date = $('<div/>').addClass('forecast-date').text(TimeCounter(res[index].time));
	    	temperature.appendTo(weather);
	    	icon.appendTo(weather);
	    	date.appendTo(container);
	    	weather.appendTo(container);
	        container.appendTo($('.forecast'));
	        getSVG(res[index].icon, icon)
    	};
    })
}