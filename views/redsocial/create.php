<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Redsocial */

$this->title = 'Create Redsocial';
$this->params['breadcrumbs'][] = ['label' => 'Redsocials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="redsocial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
