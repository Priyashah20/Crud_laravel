@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
	<h1>Dashboard</h1>
	<div class="chart-container col-lg-6">
		<h5>Pie Chart</h5>
		<canvas id="pieChart"></canvas>
	</div>
	<div class="chart-container col-lg-6">
		<h5>Line Chart</h5>
		<canvas id="lineChart"></canvas>
	</div>
	<div class="chart-container col-lg-6">
		<h5>Bar Chart</h5>
		<canvas id="barChart"></canvas>
	</div>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css"/>
@stop

@section('js')
<script> console.log('Hi!'); </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
<script>
var ctx = document.getElementById('pieChart');
var myChart = new Chart(ctx, {
type: 'pie',
data: {
	labels: ['Admin', 'Manager', 'Trainer', 'Trainee'],
	datasets: [{
		label: '# of Votes',
		data: [ {{ 10 }},{{ 20 }},{{ 30 }},{{ 15 }},],
		backgroundColor: [
		'rgba(255, 99, 132, 1)',
		'rgba(75, 192, 192, 1)',
		'rgba(54, 162, 235, 1)',
		'rgba(153, 102, 255, 1)'
		],
		borderColor: ['red','green','blue','Purple'],
		borderWidth: 2
	}]
},
options: {
	scales: {
		y: {
			beginAtZero: true
		}
	}
}
});
</script>
<script>
var ctx = document.getElementById('lineChart');
var myChart = new Chart(ctx, {
type: 'line',
data: {
	labels: ['Users', 'Category', 'Products', 'Admin'],
	datasets: [{
		label: 'Votes',
		data: [ {{ 100 }},{{ 200 }},{{ 300}},{{ 150 }},],
		backgroundColor: [
		'rgba(75, 192, 192, 1)',
		'rgba(255, 99, 132, 1)',
		'rgba(54, 162, 235, 1)',
		'rgba(153, 102, 255, 1)'
		],
		borderColor: ['red','green','blue','Purple'],
		borderWidth: 2
	}]
},
options: {
	scales: {
		y: {
			beginAtZero: true
		}
	}
}
});

</script>
<script>
var ctx = document.getElementById('barChart');
var myChart = new Chart(ctx, {
type: 'bar',
data: {
	labels: ['Users', 'Category', 'Products', 'Admin'],
	datasets: [{
		label: '# of Votes',
		data: [ {{ 500 }},{{ 300 }},{{ 600}},{{ 50 }},],
		backgroundColor: ['#df6a87','#6acddf','#bb2869','#964B00'],
		borderColor: ['#df6a87','#6acddf','#bb2869','#964B00'],
		borderWidth: 2
	}]
},
options: {
	scales: {
		y: {
			beginAtZero: true
		}
	}
}
});
</script>
@stop
