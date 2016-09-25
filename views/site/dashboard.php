<?php
	
?>
<div class="container">
	<div class="row">
		<div class="col-sm-12 company-info">
			<img src="" alt="test company">
			<h2>Panel de Métricas – Test company</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 user-info">
			<h3>test user</h2>
		</div>
	</div>
	<div class="row date-filter">
		<div class="col-sm-4 ">
			<label>Fecha Inicial</label>

		</div>
		<div class="col-sm-4">
			<label>Fecha Final</label>

		</div>
	</div>
	<div class="row result-filter">
		<div class="col-sm-12 col-md-4 col-md-offset-2 chart-wrapper">
			<h3>Datos por Género</h3>
			<div class="chart-gender">
				<canvas id="gender-chart" width="100%" height="100%"></canvas>
			</div>
		</div>
		<div class="col-sm-12 col-md-4 chart-wrapper">
			<h3>Datos por Grupos de Edad</h3>
			<div class="chart-age">
				<canvas id="age-chart" width="100%" height="100%"></canvas>
			</div>
		</div>
		<div class="col-sm-"></div>
	</div>
</div>
<script type="text/javascript">
	
	// ======================================================
	// Pie Chart
	// ======================================================

	// Doughnut Chart Options
	var pieOptions = {
		//Boolean - Whether we should show a stroke on each segment
		segmentShowStroke : true,
		
		//String - The colour of each segment stroke
		segmentStrokeColor : "#fff",
		
		//Number - The width of each segment stroke
		segmentStrokeWidth : 2,
		
		//The percentage of the chart that we cut out of the middle.
		percentageInnerCutout : 50,
		
		//Boolean - Whether we should animate the chart	
		animation : true,
		
		//Number - Amount of animation steps
		animationSteps : 100,
		
		//String - Animation easing effect
		animationEasing : "easeOutBounce",
		
		//Boolean - Whether we animate the rotation of the Doughnut
		animateRotate : true,

		//Boolean - Whether we animate scaling the Doughnut from the centre
		animateScale : true,
		
		//Function - Will fire on animation completion.
		onAnimationComplete : null
	}


	// Doughnut Chart Data
	var data = {
	    labels: [
	        "Red",
	        "Blue",
	        "Yellow"
	    ],
	    datasets: [
	        {
	            data: [300, 50, 100],
	            backgroundColor: [
	                "#FF6384",
	                "#36A2EB",
	                "#FFCE56"
	            ],
	            hoverBackgroundColor: [
	                "#FF6384",
	                "#36A2EB",
	                "#FFCE56"
	            ]
	        }]
	};

	//Get the context of the Doughnut Chart canvas element we want to select
	var ctx = document.getElementById("age-chart").getContext("2d");
	//Get the context of the Doughnut Chart canvas element we want to select
	var ctx2 = document.getElementById("gender-chart").getContext("2d");

	// Create the Doughnut Chart
	var ageChart = new Chart(ctx,{
					    type: 'pie',
					    data: data
					});
	var genderChart = new Chart(ctx2,{
					    type: 'pie',
					    data: data
					});
</script>