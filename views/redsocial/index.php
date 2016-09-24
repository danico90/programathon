<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RedsocialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Redsocials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="redsocial-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Redsocial', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TipoRedSocialID',
            'Comentario',
            'InformacionContacto',
            'PymeID',
            'Link',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
