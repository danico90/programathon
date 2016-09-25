<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Sector;
use app\models\Pais;
use app\models\Genero;
use app\models\Estado;

/* @var $this yii\web\View */
/* @var $model app\models\Pyme */
/* @var $userModel app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */

$estadoModel = Estado::findOne(['Id' => $model->EstadoID]);

if ($estadoModel) {
    $paisModel = Pais::findOne(['Id' => $estadoModel->PaisID ]);
    $estadoList = ArrayHelper::map(Estado::findAll(['PaisID' => $paisModel->Id]), 'Id', 'Nombre');
}
else {
    $paisModel = new Pais;
    $estadoList = [];
}
    function array_unshift_assoc(&$arr, $key, $val) 
    { 
        $arr = array_reverse($arr, true); 
        $arr[$key] = $val; 
        $arr = array_reverse($arr, true); 
        return $arr;
    }

    $years = array();
    $curYear = date("Y");
    $start = 1900;
    for ($x = $start; $x < $curYear + 1; $x++) {
        if ($x==1900) {
            array_unshift_assoc($years, '', '');
        }

        $years[(substr($x, 2, 3))] = $x;
    }

    $pymeIsNew = !isset($model->Id);
    if($pymeIsNew){
        $returnPage = Url::toRoute(['site/login']);
    }
    else{
        $returnPage = Url::toRoute(['site/dashboard']);
    }

    sort($years);

?>

<div class="pyme-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php if(!$pymeIsNew) : ?>
        <div class="hidden">
            <?= $form->field($model, 'Id')->hiddenInput() ?>
            <?= $form->field($model, 'FechaCreacion')->hiddenInput() ?>
            <?= $form->field($model, 'EsFacebookAppInstalado')->hiddenInput() ?>
            <?= $form->field($userModel, 'UsuarioEstadoId')->hiddenInput() ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 wow fadeInUpBig pyme-form-section" >
            <?= $form->field($model, 'NombreComercio')->textInput(['maxlength' => true, 'disabled' => !$pymeIsNew ]) ?>

            <?= $form->field($paisModel, 'Id')
                ->dropDownList(
                    ArrayHelper::map(Pais::find()->all(), 'Id', 'Nombre'),           // Flat array ('id'=>'label')
                    ['prompt'=>'',
                    'onchange'=>'
                        $.post( "'.Yii::$app->urlManager->createUrl('pais/item?id=').'"+$(this).val(), function( data ) {
                        $( "select#pyme-estadoid" ).html( data );
                        });'
                        ]    // options
                )
                ?>

            <?php if (!$estadoModel) : ?>
                <?= $form->field($model, 'EstadoID')->dropDownList(['-- Select a country --']) ?>
            <?php else : ?>
                <?= $form->field($model, 'EstadoID')->dropDownList($estadoList)?>
            <?php endif; ?>
            
            <?= $form->field($model, 'SectorID') ->dropDownList(
                ArrayHelper::map(Sector::find()->all(), 'Id', 'Nombre'),           // Flat array ('id'=>'label')
                ['prompt'=>'']    // options
            )?>

            <?= $form->field($model, 'CedJuridica')->textInput(['maxlength' => true]) ?>
            
<<<<<<< HEAD
        ?>
            <?= $form->field($model, 'EstadoID')
                ->dropDownList(['-- Seleccione un país --'])
            ?>
=======
            <?= $form->field($model, 'AnnoInicioOperaciones')->dropDownList($years); ?>
>>>>>>> 262cd8597e57e03614580114e49ac97f125937f7

            <?= $form->field($model, 'GeneroPropietarioID')-> dropDownList(
                    ArrayHelper::map(Genero::find()->all(), 'Id', 'Nombre'),           // Flat array ('id'=>'label')
                    ['prompt'=>'']    // options
                )
            ?>
            
        </div>
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 wow fadeInUpBig pyme-form-section" >
            
            <?= $form->field($model, 'NumeroTelefono')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'Direccion')->textInput(['maxlength' => true]) ?>

            <?php if( !$pymeIsNew ) : ?>
                <?= $form->field($model, 'EsActiva')->checkbox(['class' => "IsActiveInput"]); ?>
            <?php endif; ?>

            <?= $form->field($model, 'EsNegocioFamiliar')->checkbox() ?>

            <?php if($pymeIsNew) : ?>
                <?= $form->field($model, 'Logo')->fileInput() ?>
            <?php else : ?>
                <?= $form->field($model, 'LogoUpdate')->fileInput() ?>
                <?= '<img style="max-height: 100px;" src="data:image/' . $model->ExtensionLogo . ';base64,' . base64_encode($model->Logo) . '"/>' ?>
            <?php endif;?>

        </div>
        <!-- Second Group of questions -->
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 wow fadeInUpBig pyme-form-section" >
            <h2>Redes Sociales</h2>
            <hr>
            <?= $form->field($socialModels, 'linkFacebook')->textInput(['maxlength' => true]) ?>
            <?= $form->field($socialModels, 'linkTwitter')->textInput(['maxlength' => true]) ?>
            <?= $form->field($socialModels, 'linkLinkedIn')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 wow fadeInUpBig pyme-form-section" >
            <?= $form->field($socialModels, 'linkYoutube')->textInput(['maxlength' => true]) ?>
            <?= $form->field($socialModels, 'linkWebsite')->textInput(['maxlength' => true]) ?>
            <?= $form->field($socialModels, 'correoContacto')->textInput(['maxlength' => true]) ?>
        </div>
        <!-- Third Group of questions -->
         <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 wow fadeInUpBig pyme-form-section" >
            <h2>Usuario</h2>
            <hr>
            <?php if($pymeIsNew) : ?>
                <?= $form->field($userModel, 'ID')->hiddenInput() ?>
            <?php endif; ?>
            <?= $form->field($userModel, 'NombreCompleto')->textInput(['maxlength' => true]) ?>
            <?= $form->field($userModel, 'Usuario')->textInput(['maxlength' => true]) ?>
            <?= $form->field($userModel, 'Clave')->passwordInput(['maxlength' => true]) ?>
            <?= $form->field($userModel, 'RepetirClave')->passwordInput(['maxlength' => true]) ?>
            <?= $form->field($userModel, 'EmailContacto')->textInput(['maxlength' => true]) ?>
            <?= $form->field($userModel, 'RepetirEmailContacto')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 wow fadeInUpBig pyme-form-section" >
            <hr>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['data-message'=> "¿Desea desactivar la PYME?" ,'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <a class="verify-continue btn btn-danger" data-message="¿Desea salir sin guardar los cambios?" href="<?php echo $returnPage; ?>">Cancelar</a>
            </div>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    $(document).ready(function($) {
        app.templates.pymeCreateUpdateForm.init();
    });
</script>
