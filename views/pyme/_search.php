<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PymeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pyme-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'NombreComercio') ?>

    <?= $form->field($model, 'EstadoID') ?>

    <?= $form->field($model, 'SectorID') ?>

    <?= $form->field($model, 'AnnoInicioOperaciones') ?>

    <?php // echo $form->field($model, 'NumeroTelefono') ?>

    <?php // echo $form->field($model, 'Direccion') ?>

    <?php // echo $form->field($model, 'EsActiva')->checkbox() ?>

    <?php // echo $form->field($model, 'EsNegocioFamiliar')->checkbox() ?>

    <?php // echo $form->field($model, 'Logo') ?>

    <?php // echo $form->field($model, 'ExtensionLogo') ?>

    <?php // echo $form->field($model, 'FechaCreacion') ?>

    <?php // echo $form->field($model, 'FechaUltimaActualizacion') ?>

    <?php // echo $form->field($model, 'EsFacebookAppInstalado')->checkbox() ?>

    <?php // echo $form->field($model, 'UsuarioID') ?>

    <?php // echo $form->field($model, 'GeneroPropietarioID') ?>

    <?php // echo $form->field($model, 'CedJuridica') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
