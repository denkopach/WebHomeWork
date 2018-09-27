<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weather</title>
    <link rel="stylesheet" href="styles/app.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand|Titillium+Web" rel="stylesheet">
</head>
<body>
<header>
    <h1>Modern weather app</h1>
</header>
<nav>
    <a id="json" href="" class="active">JSON</a>
    <a id="db" href="">Database</a>
    <a id="api" href="">API</a>
</nav>
<main>
    <div class="container">
        <div class="error-message hidden"></div>
        <div class="weatherNow clearfix">
            <div class="all-50">
                <div class="date">
                    Friday 21/04
                </div>
                <div class="current-temperature">
                    24 &deg;
                </div>
            </div>
            <div class="all-50">
                <div class="weather-icon">
                    <img src="" class="svg">
                </div>
            </div>
        </div>
        <div class="forecast">
        </div>
    </div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="scripts/app.js"></script>
</body>
</html>
