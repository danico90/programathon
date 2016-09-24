<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pyme */

$this->title = 'Create Pyme';
$this->params['breadcrumbs'][] = ['label' => 'Pymes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pyme-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
