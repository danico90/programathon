<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Widget;
use yii\bootstrap\Dropdown;
use app\models\Pais;

$this->title = 'Login';

?>

<?php if(isset($_GET['success'])) : ?>
    <div class="alert alert-success" role="alert">Información guardada/actualizada con éxito</div>
<?php endif; ?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'comercialName')->textInput() ?>

        

        <?= $form->field($model, 'country')
        ->dropDownList(
            ArrayHelper::map(Pais::find()->all(), 'Id', 'Nombre'),           // Flat array ('id'=>'label')
            ['prompt'=>'']    // options
        )
        ?>

        <?= $form->field($model, 'username')->textInput() ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        
        <div class="form-group">
            <div class="col-lg-offset-1 col-xs-4 col-lg-2">
                <?= Html::submitButton('Cancel', ['class' => 'btn btn-primary', 'name' => 'login-button', 'onclick'=>'return false;']) ?>
            </div>
            <div class="col-xs-4 col-lg-2">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-1 col-xs-4 col-lg-11">
                <a href="<?= Url::toRoute(['pyme/create']);?>">Registro</a>
            </div>
            <div class="col-lg-offset-1 col-sm-4 col-xs-4 col-lg-11">
                <a href="mailto:contacto@fundes.com" onclick="">Olvidé la contraseña</a>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
