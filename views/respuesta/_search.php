<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RespuestaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="respuesta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'Respuesta01') ?>

    <?= $form->field($model, 'Respuesta02') ?>

    <?= $form->field($model, 'Respuesta03') ?>

    <?= $form->field($model, 'Respuesta04') ?>

    <?php // echo $form->field($model, 'Respuesta05') ?>

    <?php // echo $form->field($model, 'FechaRespuesta') ?>

    <?php // echo $form->field($model, 'GeneroID') ?>

    <?php // echo $form->field($model, 'Campo01') ?>

    <?php // echo $form->field($model, 'Campo02') ?>

    <?php // echo $form->field($model, 'RangoEdad') ?>

    <?php // echo $form->field($model, 'PymeID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
