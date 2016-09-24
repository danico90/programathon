<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AppUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'App Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create App User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'UserID',
            'Name',
            'LastName',
            'Active',
            'Password',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
