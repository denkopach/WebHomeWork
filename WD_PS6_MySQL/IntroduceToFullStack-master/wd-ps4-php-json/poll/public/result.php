<?php
session_start();
$config = require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR . 'config.php';
require_once $config['vote_php'];

if (isset($_SESSION['exception'])) :?>
    <div id='modal' class='modal'>
        <!-- Modal content -->
        <div class='modal-content'>
            <p class='error'><?= $_SESSION['exception'] ?></p>
            <span class='close' id='close-btn'>&times;</span>
        </div>
    </div>
<?php endif;
try {
    $pollData = checkVoteResults($config['charts_json']);
} catch (Exception $e) {
    $_SESSION['exception'] = $e->getMessage();
    header('Location: ../index.php');
} ?>

<html>
<head>
    <!--Load the AJAX API-->
    <link rel='stylesheet' href='css/charts.css'>
    <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
    <script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
    <script type='text/javascript'>
        $(function () {
            const modal = $('#modal');
            $('#back-btn').on('click', function () {
                window.location.href = 'index.php'
            });
            $(window).on('click', function (event) {
                if (!$(event.target).closest('.modal-content').length) {
                    modal.addClass('hidden');
                }
            });
            $('#close-btn').on('click', function () {
                modal.addClass('hidden');
            })
        });
        // Load the Visualization API and the piechart package.
        google.charts.load('current', {'packages': ['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
// Create our data table out of JSON data loaded from server.
            let data = new google.visualization.arrayToDataTable(<?= $pollData?>);

// Instantiate and draw our chart, passing in some options.
            let chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, {width: 800, height: 480});
        }

    </script>
</head>

<body>
<button type='button' id='back-btn' class='back-btn'>Back to poll</button>
<!--Div that will hold the pie chart-->
<div id='chart_div' class='charts-div'></div>
</body>
</html>