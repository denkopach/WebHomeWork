function chart(array){
	function str_to_arr(array){
		return eval("(" + array + ")")
	};
	array = str_to_arr(array);

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