<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Respuesta */
/* @var $form yii\widgets\ActiveForm */


$options1 = json_decode(json_encode($data[0]->answers), true)[0];
$options2 = json_decode(json_encode($data[1]->answers), true)[0];
$options3 = json_decode(json_encode($data[2]->answers), true)[0];
$options4 = json_decode(json_encode($data[3]->answers), true)[0];
$options5 = json_decode(json_encode($data[4]->answers), true)[0];
$options6 = json_decode(json_encode($data[5]->answers), true)[0];
$label1 = $data[0]->question;
$label2 = $data[1]->question;
$label3 = $data[2]->question;
$label4 = $data[3]->question;
$label5 = $data[4]->question;
$label6 = $data[5]->question;


$model->PymeID = $pymeID;

?>

<div class="respuesta-form">

    <?php $form = ActiveForm::begin(['id' => 'poll-form']); ?>
   
    <?= $form->field($model, 'Respuesta01')->radioList($options1, ['class' => 'radio-group'])->label($label1) ?>
    <?= $form->field($model, 'Respuesta02')->radioList($options2, ['class' => 'radio-group'])->label($label2) ?> 
    <?= $form->field($model, 'Respuesta03')->radioList($options3, ['class' => 'radio-group'])->label($label3) ?> 
    <?= $form->field($model, 'Respuesta04')->radioList($options4, ['class' => 'radio-group'])->label($label4) ?> 
    <?= $form->field($model, 'Respuesta05')->radioList($options5, ['class' => 'radio-group'])->label($label5) ?> 
    <?= $form->field($model, 'RangoEdad')->radioList($options6, ['class' => 'radio-group'])->label($label6) ?> 

    <?= $form->field($model, 'FechaRespuesta')->textInput(['value' => $date->format('Y-m-d H:i:sP') , 'class' => 'hidden']) ?>
<div class="hidden">
    <?= $form->field($model, 'GeneroID')->hiddenInput(['maxlength' => true, 'class' => 'hidden']) ?>

    <?= $form->field($model, 'PymeID')->hiddenInput(['class' => 'hidden']) ?>
</div>

    <div class="form-group">
        <button class="btn btn-success" onclick="app.templates.createRespuesta.send()">Votar</button>
        <div class="help-block" id="fbError"></div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    $(document).on('ready', function() {
        $('.wrap').addClass('respuesta-create-container');
        $('.animated').addClass('fadeIn');
    });
</script>
