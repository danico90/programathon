<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Redsocial */

$this->title = $model->TipoRedSocialID;
$this->params['breadcrumbs'][] = ['label' => 'Redsocials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="redsocial-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'TipoRedSocialID' => $model->TipoRedSocialID, 'PymeID' => $model->PymeID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'TipoRedSocialID' => $model->TipoRedSocialID, 'PymeID' => $model->PymeID], [
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
            'TipoRedSocialID',
            'Comentario',
            'InformacionContacto',
            'PymeID',
            'Link',
        ],
    ]) ?>

</div>
