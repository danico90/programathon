<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pyme */
/* @var $userModel app\models\Usuario */
/* @var $socialModels array off app\models\RedSocial */

$this->title = 'Crear PYME';

?>
<div class="pyme-create">

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3" >
            <h1><?= Html::encode($this->title) ?></h1>
            <hr>
        </div>
        
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'userModel' => $userModel,
        'socialModels' => $socialModels,
    ]) ?>

</div>