<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Respuesta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="respuesta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Respuesta01')->textInput() ?>

    <?= $form->field($model, 'Respuesta02')->textInput() ?>

    <?= $form->field($model, 'Respuesta03')->textInput() ?>

    <?= $form->field($model, 'Respuesta04')->textInput() ?>

    <?= $form->field($model, 'Respuesta05')->textInput() ?>

    <?= $form->field($model, 'FechaRespuesta')->textInput() ?>

    <?= $form->field($model, 'GeneroID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Campo01')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Campo02')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RangoEdad')->textInput() ?>

    <?= $form->field($model, 'PymeID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
