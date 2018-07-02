const pathBackend = 'php/getDB.php';

$.ajax({
    type: "POST",
    dataType: "json",
    data: {
        'getVoteRes': true,
    },
    url: pathBackend,   
    success(responce) {
        if (responce) {
            chart(responce);
        } else {
            logErrors('the results of voting are not available');
        }
    },
    error(error) {
        logErrors(error);
    }
});

function chart(array) {
    
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        const data = google.visualization.arrayToDataTable(array);

        const options = {
            title: 'Rating of programming languages'
        };

        const chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
    
}

function logErrors(err) {
    if('<?= LOGGING ?>') {
        $('#piechart').append('the results of voting are not available');
        console.log(err);
    }
}
