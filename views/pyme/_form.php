<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Sector;
use app\models\Pais;
use app\models\Genero;


// $items = new array();

// // push_array($items, "AA");
// // push_array($items, "BB");


/* @var $this yii\web\View */
/* @var $model app\models\Pyme */
/* @var $userModel app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="pyme-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'NombreComercio')->textInput(['maxlength' => true]) ?>

    -- PAIS --

    <?= $form->field($model, 'EstadoID')->textInput() ?>

    <?= $form->field($model, 'SectorID') ->dropDownList(
            ArrayHelper::map(Sector::find()->all(), 'Id', 'Nombre'),           // Flat array ('id'=>'label')
            ['prompt'=>'']    // options
        )
    ?>

    <?= $form->field($model, 'CedJuridica')->textInput(['maxlength' => true]) ?>
    
    -- DATE --
    <?= $form->field($model, 'AnnoInicioOperaciones')->textInput() ?>

    <?= $form->field($model, 'GeneroPropietarioID')-> dropDownList(
            ArrayHelper::map(Genero::find()->all(), 'Id', 'Nombre'),           // Flat array ('id'=>'label')
            ['prompt'=>'']    // options
        )
    ?>
    
    <?= $form->field($model, 'NumeroTelefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EsActiva')->checkbox() ?>

    <?= $form->field($model, 'EsNegocioFamiliar')->checkbox() ?>

    <?= $form->field($model, 'Logo')->fileInput() ?>

    <hr>
    <!-- Second Group of questions -->
    <?= $form->field($socialModels, 'linkFacebook')->textInput(['maxlength' => true]) ?>
    <?= $form->field($socialModels, 'linkTwitter')->textInput(['maxlength' => true]) ?>
    <?= $form->field($socialModels, 'linkLinkedIn')->textInput(['maxlength' => true]) ?>
    <?= $form->field($socialModels, 'linkYoutube')->textInput(['maxlength' => true]) ?>
    <?= $form->field($userModel, 'EmailContacto')->textInput(['maxlength' => true]) ?>
    
    <hr>
    <!-- Third Group of questions -->
    <?= $form->field($userModel, 'NombreCompleto')->textInput(['maxlength' => true]) ?>
    <?= $form->field($userModel, 'Usuario')->textInput(['maxlength' => true]) ?>
    <?= $form->field($userModel, 'Clave')->textInput(['maxlength' => true]) ?>
    <?= $form->field($userModel, 'RepetirClave')->textInput(['maxlength' => true]) ?>
    <?= $form->field($userModel, 'EmailContacto')->textInput(['maxlength' => true]) ?>
    <?= $form->field($userModel, 'RepetirEmailContacto')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
