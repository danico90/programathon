<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\AppUser;
use app\models\Role;

/* @var $this yii\web\View */
/* @var $model app\models\UserRole */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-role-form">

    <?php $form = ActiveForm::begin(); ?>

   <?= Html::activeDropDownList($model, 'UserID',
      ArrayHelper::map(AppUser::find()->all(), 'UserID', 'Name')) ?>

    <?= Html::activeDropDownList($model, 'RoleID',
      ArrayHelper::map(Role::find()->all(), 'RoleID', 'Description'), ['class' => 'dropdown']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
