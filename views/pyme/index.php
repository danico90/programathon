<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PymeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pymes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pyme-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pyme', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'NombreComercio',
            'EstadoID',
            'SectorID',
            'AnnoInicioOperaciones',
            // 'NumeroTelefono',
            // 'Direccion',
            // 'EsActiva:boolean',
            // 'EsNegocioFamiliar:boolean',
            // 'Logo',
            // 'ExtensionLogo',
            // 'FechaCreacion',
            // 'FechaUltimaActualizacion',
            // 'EsFacebookAppInstalado:boolean',
            // 'UsuarioID',
            // 'GeneroPropietarioID',
            // 'CedJuridica',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
