<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$lista = ['', 'Malo', 'Regular', 'Normal', 'Bueno', 'Excelente'];
$edades = ['', '12-17', '18-33', '34-45', '46-55', '56-64', '65-73', '74+'];
?>
<div class="dashboard-container">

	<?php if(isset($_GET['success'])) : ?>
		<div class="alert alert-success" role="alert">Información guardada/actualizada con éxito</div>
	<?php endif; ?>
	<div class="row">
		<div class="col-sm-12 company-info">
			<?= '<img style="max-height: 100px;" src="data:image/' . $model->ExtensionLogo . ';base64,' . base64_encode($model->Logo) . '"/>' ?>	
			<h2>Panel de Métricas – <?=$model->NombreComercio?> <span class="edit-button"><a href="<?= Url::toRoute(['pyme/update', 'id' => $model->Id]);?>"><span class="glyphicon glyphicon-pencil"></span>Editar</a></span></h2>
			<h3><?= Yii::$app->session->get('user')->username ?></h3>
		</div>
	</div>
	<div class="col-md-12">
		<?php
		if (!$model->EsFacebookAppInstalado) {
		?>
			<button id="share-fb">Share in facebook</button>
			<?php
		}
			?>
	</div>
	<?php $form = ActiveForm::begin(); ?>
	<?php
	if (!$model->EsFacebookAppInstalado) {
		echo '<h4>Comparta el app primero para iniciar la captura de datos.</h4>';
	}
	?>
	<div class="<?=!$model->EsFacebookAppInstalado ? 'hidden' : ''?>">
		<div class="row date-filter">
			<div class="col-sm-4">
				<?= $form->field($dashboardModel, 'startDate')->textInput(['class' => 'date-picker']) ?>
			</div>
			<div class="col-sm-4">
				<?= $form->field($dashboardModel, 'endDate')->textInput(['class' => 'date-picker']) ?>
			</div>
			<div class="col-sm-4">
				<?= Html::submitButton('Consultar', ['class' => 'btn btn-primary']) ?>
			</div>
		</div>
		<div class="row result-filter">
			<div class="col-xs-12 col-sm-6 col-md-6 chart-wrapper">
				<h3>Datos por Género</h3>
				<div class="chart-gender">
					<canvas id="gender-chart" width="100%" height="100%"></canvas>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 chart-wrapper">
				<h3>Datos por grupos de Edad</h3>
				<div class="chart-age">
					<canvas id="age-chart" width="100%" height="100%"></canvas>
				</div>
			</div>
		</div>
		<div class="row result-filter">
			<div class="col-xs-12 col-sm-6 col-md-6 chart-wrapper">
				<div class="chart-general">
					<canvas id="general-chart-1" width="100%" height="100%"></canvas>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 chart-wrapper">
				<article>
					<h4>Calidad del producto o servicio</h4>
				</article>
			</div>
		</div>
		<div class="row result-filter">
			<div class="col-xs-12 col-sm-6 col-md-6 chart-wrapper">
				<article>
					<h4>Imagen de las instalaciones</h4>
				</article>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 chart-wrapper">
				<div class="chart-general">
					<canvas id="general-chart-3" width="100%" height="100%"></canvas>
				</div>
			</div>
		</div>
		<div class="row result-filter">
			<div class="col-xs-12 col-sm-6 col-md-6 chart-wrapper">
				<div class="chart-general">
					<canvas id="general-chart-2" width="100%" height="100%"></canvas>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 chart-wrapper">
				<article>
					<h4>Tiempo de espera en la atención</h4>
				</article>
			</div>
		</div>
		<div class="row result-filter">
			<div class="col-xs-12 col-sm-6 col-md-6 chart-wrapper">
				<article>
					<h4>Disponibilidad de producto o servicio solicitado</h4>
				</article>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 chart-wrapper">
				<div class="chart-general">
					<canvas id="general-chart-4" width="100%" height="100%"></canvas>
				</div>
			</div>
		</div>
		<div class="row result-filter">
			<div class="col-xs-12 col-sm-6 col-md-6 chart-wrapper">
				<div class="chart-general">
					<canvas id="general-chart-5" width="100%" height="100%"></canvas>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 chart-wrapper">
				<article>
					<h4>Atención del personal</h4>
				</article>
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
	var dataGenero = {
	    labels: [
	        <?php
			foreach ($dashboardModel->genero['key'] as $item)
			{
				echo '"'.$item.'",';
			}
			?>
	    ],
	    datasets: [
	        {
	            data: [<?= implode(',', $dashboardModel->genero['value']) ?>],
	            backgroundColor: [
	                "#FF6384",
	                "#36A2EB",
	                "#FFCE56",
					"#EEC826",
					"#787878",
					"#EFEFEF"
	            ],
	            hoverBackgroundColor: [
	                "#FF6384",
	                "#36A2EB",
	                "#FFCE56",
					"#EEC826",
					"#787878",
					"#EFEFEF"
	            ]
	        }]
	};

	var dataEdad = {
	    labels: [
	        <?php
			foreach ($dashboardModel->edad['key'] as $item)
			{
				echo '"'.$edades[$item].'",';
			}
			?>
	    ],
	    datasets: [
	        {
	            data: [<?= implode(',', $dashboardModel->edad['value']) ?>],
	            backgroundColor: [
	                "#FF6384",
	                "#36A2EB",
	                "#FFCE56",
					"#EEC826",
					"#787878",
					"#EFEFEF"
	            ],
	            hoverBackgroundColor: [
	                "#FF6384",
	                "#36A2EB",
	                "#FFCE56",
					"#EEC826",
					"#787878",
					"#EFEFEF"
	            ]
	        }]
	};

	var pregunta1 = {
	    labels: [
	        <?php
			foreach ($dashboardModel->pregunta1['key'] as $item)
			{
				echo '"'.$lista[$item].'",';
			}
			?>
	    ],
	    datasets: [
	        {
	            data: [<?= implode(',', $dashboardModel->pregunta1['value']) ?>],
	            backgroundColor: [
	                "#FF6384",
	                "#36A2EB",
	                "#FFCE56",
					"#EEC826",
					"#787878",
					"#EFEFEF"
	            ],
	            hoverBackgroundColor: [
	                "#FF6384",
	                "#36A2EB",
	                "#FFCE56",
					"#EEC826",
					"#787878",
					"#EFEFEF"
	            ]
	        }]
	};

	var pregunta2 = {
	    labels: [
	        <?php
			foreach ($dashboardModel->pregunta2['key'] as $item)
			{
				echo '"'.$lista[$item].'",';
			}
			?>
	    ],
	    datasets: [
	        {
	            data: [<?= implode(',', $dashboardModel->pregunta2['value']) ?>],
	            backgroundColor: [
	                "#FF6384",
	                "#36A2EB",
	                "#FFCE56",
					"#EEC826",
					"#787878",
					"#EFEFEF"
	            ],
	            hoverBackgroundColor: [
	                "#FF6384",
	                "#36A2EB",
	                "#FFCE56",
					"#EEC826",
					"#787878",
					"#EFEFEF"
	            ]
	        }]
	};

	var pregunta3 = {
	    labels: [
	        <?php
			foreach ($dashboardModel->pregunta3['key'] as $item)
			{
				echo '"'.$lista[$item].'",';
			}
			?>
	    ],
	    datasets: [
	        {
	            data: [<?= implode(',', $dashboardModel->pregunta3['value']) ?>],
	            backgroundColor: [
	                "#FF6384",
	                "#36A2EB",
	                "#FFCE56",
					"#EEC826",
					"#787878",
					"#EFEFEF"
	            ],
	            hoverBackgroundColor: [
	                "#FF6384",
	                "#36A2EB",
	                "#FFCE56",
					"#EEC826",
					"#787878",
					"#EFEFEF"
	            ]
	        }]
	};

	var pregunta4 = {
	    labels: [
	        <?php
			foreach ($dashboardModel->pregunta4['key'] as $item)
			{
				echo '"'.$lista[$item].'",';
			}
			?>
	    ],
	    datasets: [
	        {
	            data: [<?= implode(',', $dashboardModel->pregunta4['value']) ?>],
	            backgroundColor: [
	                "#FF6384",
	                "#36A2EB",
	                "#FFCE56",
					"#EEC826",
					"#787878",
					"#EFEFEF"
	            ],
	            hoverBackgroundColor: [
	                "#FF6384",
	                "#36A2EB",
	                "#FFCE56",
					"#EEC826",
					"#787878",
					"#EFEFEF"
	            ]
	        }]
	};

	var pregunta5 = {
	    labels: [
	        <?php
			foreach ($dashboardModel->pregunta5['key'] as $item)
			{
				echo '"'.$lista[$item].'",';
			}
			?>
	    ],
	    datasets: [
	        {
	            data: [<?= implode(',', $dashboardModel->pregunta5['value']) ?>],
	            backgroundColor: [
	                "#FF6384",
	                "#36A2EB",
	                "#FFCE56",
					"#EEC826",
					"#787878",
					"#EFEFEF"
	            ],
	            hoverBackgroundColor: [
	                "#FF6384",
	                "#36A2EB",
	                "#FFCE56",
					"#EEC826",
					"#787878",
					"#EFEFEF"
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
					    data: dataGenero
					});
	var genderChart = new Chart(ctx2,{
					    type: 'pie',
					    data: dataEdad
					});
	var generalChart1 = new Chart(ctx3,{
					    type: 'pie',
					    data: pregunta1
					});
	var generalChart2 = new Chart(ctx4,{
					    type: 'pie',
					    data: pregunta2
					});
	var generalChart3 = new Chart(ctx5,{
					    type: 'pie',
					    data: pregunta3
					});
	var generalChart4 = new Chart(ctx6,{
					    type: 'pie',
					    data: pregunta4
					});
	var generalChart5 = new Chart(ctx7,{
					    type: 'pie',
					    data: pregunta5
					});
</script>

<script>
	$(document).ready(function() {
		app.initializers.fbSDK.init().then(function() {
			$('#share-fb').on('click', function() {
				app.initializers.fbSDK.share(window.location.origin + '/respuesta/create?id=' + <?php echo $pymeId ;?>);
				$.post( "<?=Yii::$app->urlManager->createUrl('site/activate')?>", function( data ) {
                  console.log('data', data);
                });
			});
		});
	});
</script>