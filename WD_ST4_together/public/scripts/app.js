// Need HTML elements
const navEl = $("nav");
const weatherNow = $(".weatherNow");
const forecast = $(".forecast");
const errorEl = $(".error-message");

// Svg insertion
function insertSvg(name) {
    return $('<img>', {class: 'svg', src: `img/icons/${name}.svg`, fill: 'white'});
}

// Change current weather section
function changewWeatherNow(response) {
    const firstForecastIndex = 0;
    const date = new Date(response[firstForecastIndex]["time"] * 1000);
    const options = {
        weekday: 'long',
        day: 'numeric',
        month: 'numeric'
    };

    weatherNow.find(".date")
        .text(date.toLocaleString("en", options));

    weatherNow.find(".current-temperature")
        .html(`${response[firstForecastIndex]["temperature"]}  ° `);
    weatherNow.find(".weather-icon").empty().append(insertSvg(response[firstForecastIndex]["icon"]));
}

// Create forecasts list
function createForecast(response) {
    forecast.empty();

    for (let i in response) {
        const forecastEl = $("<div/>", {class: 'hourly-forecast clearfix'});
        const date = new Date(response[i]['time'] * 1000);
        const options = {
            hour: 'numeric',
            minute: 'numeric'
        };

        $("<div/>", {class: 'forecast-date', text: date.toLocaleString("ru", options)})
            .appendTo(forecastEl);
        $("<div/>", {class: 'forecast-weather'})
            .append($("<div/>", {class: 'forecast-temperature', html: `${response[i]["temperature"]} ° `}))
            .append($("<div/>", {class: 'forecast-icon'}).append(insertSvg(response[i]["icon"])))
            .appendTo(forecastEl);
        forecastEl.appendTo(forecast);
    }
    imgsToSvg();
}

// View data for selected service
function selectService(clickedEl) {
    $.ajax({
        url: "index.php",
        method: "POST",
        data: {handler: clickedEl.attr("id")},
        dataType: "json"
    }).done(function (response) {
        weatherNow.removeClass("hidden");
        forecast.removeClass("hidden");
        if (errorEl.text()) {
            errorEl.addClass("hidden").text("");
        }

        changewWeatherNow(response);
        createForecast(response);
    }).fail(function (response) {
        if (!weatherNow.hasClass("hidden")) {
            weatherNow.addClass("hidden");
        }

        if (!forecast.hasClass("hidden")) {
            forecast.addClass("hidden");
        }

        errorEl.removeClass("hidden").text(response.responseText);
    }).always(function () {
        navEl.find("a.active").removeClass("active");
        clickedEl.addClass("active");
    });
}

// First start
selectService(navEl.children().first());

// Click listener
navEl.on("click", "a", function (e) {
    e.preventDefault();
    selectService($(this));
});

function imgsToSvg() {
    jQuery('img.svg').each(function(){
        let $img = jQuery(this);
        let imgID = $img.attr('id');
        let imgClass = $img.attr('class');
        let imgURL = $img.attr('src');

        jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            let $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Check if the viewport is set, if the viewport is not set the SVG wont't scale.
            if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
            }

            // Replace image with new SVG
            $img.replaceWith($svg);
            $svg.attr('fill', 'white');
        }, 'xml');

    });
}
