<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pyme */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pyme-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NombreComercio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EstadoID')->textInput() ?>

    <?= $form->field($model, 'SectorID')->textInput() ?>

    <?= $form->field($model, 'AnnoInicioOperaciones')->textInput() ?>

    <?= $form->field($model, 'NumeroTelefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EsActiva')->checkbox() ?>

    <?= $form->field($model, 'EsNegocioFamiliar')->checkbox() ?>

    <?= $form->field($model, 'Logo')->textInput() ?>

    <?= $form->field($model, 'ExtensionLogo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FechaCreacion')->textInput() ?>

    <?= $form->field($model, 'FechaUltimaActualizacion')->textInput() ?>

    <?= $form->field($model, 'EsFacebookAppInstalado')->checkbox() ?>

    <?= $form->field($model, 'UsuarioID')->textInput() ?>

    <?= $form->field($model, 'GeneroPropietarioID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CedJuridica')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
