@extends('layouts.main')

@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

	var data = google.visualization.arrayToDataTable([
	  ['Expense Category', 'Amount'],
	  <?php echo $chartData; ?>
	]);

	var options = {
	  title: 'My Expenses'
	};

	var chart = new google.visualization.PieChart(document.getElementById('piechart'));

	chart.draw(data, options);
  }
</script>
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"></h1>
		<div class="pull-right">
			<span>Dashboard</span>
		</div>
	</div>
	<div class="row">
		<div id="piechart" style="width: 900px; height: 500px;"></div>
	</div>
</div>
@endsection
