$.ajax({
		type: "POST",
		url: 'php/res.php',
		data: {
			getVoteRes: true,
		},	
		success(ressponce) {
			if (ressponce) {
				chart(ressponce);
			}	
		}
	});

function chart(array){
	array = JSON.parse(array);
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