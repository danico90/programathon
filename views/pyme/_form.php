<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Pais;
use app\models\Estado;

/* @var $this yii\web\View */
/* @var $model app\models\Pyme */
/* @var $form yii\widgets\ActiveForm */

$estadoModel = Estado::findOne(['Id' => $model->EstadoID]);
if ($estadoModel) {
    $paisModel = Pais::findOne(['Id' => $estadoModel->PaisID ]);
    $estadoList = ArrayHelper::map(Estado::findAll(['PaisID' => $paisModel->Id]));
}
else {
    $paisModel = new Pais;
    $estadoList = [];
}

?>

<div class="pyme-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NombreComercio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($paisModel, 'Id')
        ->dropDownList(
            ArrayHelper::map(Pais::find()->all(), 'Id', 'Nombre'),           // Flat array ('id'=>'label')
            ['prompt'=>'',
            'onchange'=>'
                $.post( "'.Yii::$app->urlManager->createUrl('pais/item?id=').'"+$(this).val(), function( data ) {
                  $( "select#pyme-estadoid" ).html( data );
                });'
                ]    // options
        )
        ?>

        <?php
        if (!$estadoModel) {
            
        ?>
            <?= $form->field($model, 'EstadoID')
                ->dropDownList(['-- Select a country --'])
            ?>
        <?php
        }
        else {
            
        ?>
            <?= $form->field($model, 'EstadoID')
                ->dropDownList($estadoList)
            ?>
        <?php
        }
        ?>

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
