<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserRole */

$this->title = $model->UserID;
$this->params['breadcrumbs'][] = ['label' => 'User Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-role-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'UserID' => $model->UserID, 'RoleID' => $model->RoleID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'UserID' => $model->UserID, 'RoleID' => $model->RoleID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'UserID',
            'RoleID',
        ],
    ]) ?>

</div>
