<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tiporedsocial */

$this->title = 'Update Tiporedsocial: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Tiporedsocials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tiporedsocial-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
