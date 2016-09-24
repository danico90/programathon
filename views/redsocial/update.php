<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Redsocial */

$this->title = 'Update Redsocial: ' . $model->TipoRedSocialID;
$this->params['breadcrumbs'][] = ['label' => 'Redsocials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TipoRedSocialID, 'url' => ['view', 'TipoRedSocialID' => $model->TipoRedSocialID, 'PymeID' => $model->PymeID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="redsocial-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
