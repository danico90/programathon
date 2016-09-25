<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Respuesta */

$this->title = 'Encuesta';
?>
<div class="respuesta-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
    ]) ?>

</div>
