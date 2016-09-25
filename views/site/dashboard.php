<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="dashboard-container">
<?php
echo $pymeId;
?>

	<?php if(isset($_GET['success'])) : ?>
		<div class="alert alert-success" role="alert">Información guardada/actualizada con éxito</div>
	<?php endif; ?>
	<div class="row">
		<div class="col-sm-12 company-info">
			<?= '<img style="max-height: 100px;" src="data:image/' . $model->ExtensionLogo . ';base64,' . base64_encode($model->Logo) . '"/>' ?>	
			<h2>Panel de Métricas – <?=$model->NombreComercio?><a href="<?= Url::toRoute(['pyme/update', 'id' => $model->Id]);?>"><span class="glyphicon glyphicon-pencil"></span></a></h2>	
		</div>
	</div>
	<?php $form = ActiveForm::begin(); ?>
	<div class="row">
		<div class="col-sm-12 user-info">
			<h3><?= Yii::$app->session->get('user')->username ?></h3>
		</div>
	</div>
	<div class="row date-filter">
		<div class="col-sm-4 ">
			<?= $form->field($dashboardModel, 'startDate')->textInput(['class' => 'date-picker']) ?>
		</div>
		<div class="col-sm-4">
			<?= $form->field($dashboardModel, 'endDate')->textInput(['class' => 'date-picker']) ?>
		</div>
		<div class="col-sm-4">
		
		<?= Html::submitButton('Consultar', ['class' => 'btn btn-primary']) ?>
		</div>
		<div class="col-xs-12"><div class="divider-border"></div></div>
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
			<div class="chart-general">
				<canvas id="general-chart-1" width="100%" height="100%"></canvas>
			</div>
		</div>
		<div class="col-xs-12"><div class="divider-border"></div></div>
		<div class="col-xs-12 col-sm-6 col-md-4 chart-wrapper">
			<h3>Calidad del producto o servicio</h3>
			<div class="chart-general">
				<canvas id="general-chart-2" width="100%" height="100%"></canvas>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4 chart-wrapper">
			<h3>Tiempo de espera en la atención</h3>
			<div class="chart-general">
				<canvas id="general-chart-3" width="100%" height="100%"></canvas>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4 chart-wrapper">
			<h3>Imagen de las instalaciones</h3>
			<div class="chart-general">
				<canvas id="general-chart-4" width="100%" height="100%"></canvas>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4 chart-wrapper">
			<h3>Disponibilidad de producto o servicio solicitado</h3>
			<div class="chart-general">
				<canvas id="general-chart-5" width="100%" height="100%"></canvas>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4 chart-wrapper">
			<h3>Atención del personal</h3>
			<div class="chart-age">
				<canvas id="age-chart" width="100%" height="100%"></canvas>
			</div>
		</div>
	</div>
	<?php ActiveForm::end(); ?>
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

	var ctx3 = document.getElementById("general-chart-1").getContext("2d");
	var ctx4 = document.getElementById("general-chart-2").getContext("2d");
	var ctx5 = document.getElementById("general-chart-3").getContext("2d");
	var ctx6 = document.getElementById("general-chart-4").getContext("2d");
	var ctx7 = document.getElementById("general-chart-5").getContext("2d");
	// Create the Doughnut Chart
	var ageChart = new Chart(ctx,{
					    type: 'pie',
					    data: data
					});
	var genderChart = new Chart(ctx2,{
					    type: 'pie',
					    data: data
					});
	var generalChart1 = new Chart(ctx3,{
					    type: 'pie',
					    data: data
					});
	var generalChart2 = new Chart(ctx4,{
					    type: 'pie',
					    data: data
					});
	var generalChart3 = new Chart(ctx5,{
					    type: 'pie',
					    data: data
					});
	var generalChart4 = new Chart(ctx6,{
					    type: 'pie',
					    data: data
					});
	var generalChart5 = new Chart(ctx7,{
					    type: 'pie',
					    data: data
					});
</script>