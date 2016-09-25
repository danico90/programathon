<?php




use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pyme */
/* @var $userModel app\models\Usuario */
/* @var $socialModels array off app\models\RedSocial */

$this->title = 'Create Pyme';
$this->params['breadcrumbs'][] = ['label' => 'Pymes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pyme-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userModel' => $userModel,
        'socialModels' => $socialModels,
    ]) ?>

</div>
