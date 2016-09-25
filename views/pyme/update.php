<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pyme */
/* @var $userModel app\models\Usuario */
/* @var $socialModels array off app\models\RedSocial */

$this->title = 'Update Pyme: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Pymes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pyme-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userModel' => $userModel,
        'socialModels' => $socialModels,
    ]) ?>

</div>
