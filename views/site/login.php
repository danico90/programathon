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
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal site-login login', 'name' => 'login-form'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <p class="title"><?= Html::encode($this->title) ?></p>

        <?= $form->field($model, 'comercialName')->textInput() ?>
        <i class="fa fa-comercio"></i>

        <?= $form->field($model, 'country')
        ->dropDownList(
            ArrayHelper::map(Pais::find()->all(), 'Id', 'Nombre'),           // Flat array ('id'=>'label')
            ['prompt'=>'']    // options
        )
        ?>

        <?= $form->field($model, 'username')->textInput() ?>
        <i class="fa fa-user"></i>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <i class="fa fa-key"></i>
        <a class="pull-left" href="<?= Url::toRoute(['pyme/create']);?>">Registro</a>
        <a class="pull-right" href="mailto:contacto@fundes.com" onclick="">Olvidé la contraseña</a>
        <button>
          <i class="spinner"></i>
          <span class="state">Ingresar</span>
        </button>
        <div class="close" tabindex="1"><input type="button" value="X" class="close-input" onClick="this.form.reset()"/></div>
<!--         <div class="form-group">
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
        </div> -->

    <?php ActiveForm::end(); ?>

<!--     setTimeout(function() {
            $this.addClass('ok');
            $state.html('Welcome back!');
            setTimeout(function() {
              $state.html('Log in');
              $this.removeClass('ok loading');
              working = false;
            }, 4000);
          }, 3000); -->