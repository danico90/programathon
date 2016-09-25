<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Respuesta */

$this->title = 'Encuesta';
?>
<div class="respuesta-create animated">

    <?php if (Yii::$app->session->hasFlash('pollFormSubmitted')): ?>

        <div class="alert alert-success">
            Encuesta enviada exitosamente, gracias.
        </div>

    <?php else: ?>
    	<h1><?= Html::encode($this->title) ?></h1>
		<?= $this->render('_form', [
	        'model' => $model,
	        'data' => $data,
	        'date' => $date,
			'pymeID' => $pymeID,
	    ]) ?>
	<?php endif; ?>
</div>

<script>
$(document).ready(function() {
	app.initializers.fbSDK.init().then(function() {
		
	});
});
	
</script>
