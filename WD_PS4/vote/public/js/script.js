const pathBackend = 'php/getDB.php';

$.ajax({
	type: "POST",
	data: {
		'getVoteRes': true,
	},
	url: pathBackend,	
	success(ressponce) {
		try {
			var json = JSON.parse(ressponce);
		} catch (err){
			logErrors(err);
		}
		if (json) {
			chart(json);
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
	console.log(err);
}