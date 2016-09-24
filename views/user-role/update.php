<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserRole */

$this->title = 'Update User Role: ' . $model->UserID;
$this->params['breadcrumbs'][] = ['label' => 'User Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->UserID, 'url' => ['view', 'UserID' => $model->UserID, 'RoleID' => $model->RoleID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-role-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
