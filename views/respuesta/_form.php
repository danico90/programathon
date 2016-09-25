<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Respuesta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="respuesta-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php  
        foreach($data as $question){
            echo '<div class="question-row row">';
            echo '<label class="col-sm-4 control-label required" for="respuesta-'.$question->id.'">'.$question->question.'</label>';
            echo '<div class="anwers-row col-sm-8">';
            
                foreach($question->anwers as $anwers){
                   
                }
            echo '</div>';
            echo '<div class="help-block"></div>';
            echo '</div></br>';
        } 
    ?>

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
