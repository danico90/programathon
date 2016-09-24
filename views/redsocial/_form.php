<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Redsocial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="redsocial-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TipoRedSocialID')->textInput() ?>

    <?= $form->field($model, 'Comentario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'InformacionContacto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PymeID')->textInput() ?>

    <?= $form->field($model, 'Link')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
