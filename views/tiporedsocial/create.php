<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tiporedsocial */

$this->title = 'Create Tiporedsocial';
$this->params['breadcrumbs'][] = ['label' => 'Tiporedsocials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tiporedsocial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
