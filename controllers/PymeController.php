<?php

namespace app\controllers;

use Yii;
use app\models\Pyme;
use app\models\PymeSearch;
use app\models\Usuario;
use app\models\UsuarioSearch;
use app\models\RedSocial;
use app\models\RedSocialSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\DbMatch\TipoRedSocialID;
use app\models\PymeSocialMedias;
use yii\web\UploadedFile;

/**
 * PymeController implements the CRUD actions for Pyme model.
 */
class PymeController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pyme models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PymeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pyme model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pyme model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pyme;
        $socialModels = new PymeSocialMedias;
        $userModel = new Usuario;

        $posted = Yii::$app->request->post();

        if($posted && sizeof($posted) > 0) {

            $userModel->load($posted);
            $model->load($posted);
            $socialModels->load($posted);
            $userModel->UsuarioEstadoId = $model->EstadoID;

            if( $userModel && $model && $socialModels ) {

                if( $userModel->save() ) {

                    $model->UsuarioID = $userModel->ID;
                    $model->FechaCreacion = date("Y-m-d H:i:s");
                    $model->FechaUltimaActualizacion = date("Y-m-d H:i:s");
                    $model->EsFacebookAppInstalado = 0;
                    $model->EsActiva = 1;

                    if($file=UploadedFile::getInstance($model, 'Logo'))
                    {
                        $model->Logo=file_get_contents($file->tempName);
                        $model->ExtensionLogo = pathinfo($file->name, PATHINFO_EXTENSION);
                    }
                    
                    if ($model->save(false)) {

                        // Facebook
                        $Linkfacebook = new RedSocial();
                        $Linkfacebook->Link = $socialModels->linkFacebook;
                        $Linkfacebook->PymeID = $model->Id;
                        $Linkfacebook->TipoRedSocialID = TipoRedSocialID::Facebook;
                        $Linkfacebook->save();

                        // Twitter
                        if( $socialModels->linkTwitter ){
                            $LinkTwitter = new RedSocial();
                            $LinkTwitter->Link = $socialModels->linkTwitter;
                            $LinkTwitter->PymeID = $model->Id;
                            $LinkTwitter->TipoRedSocialID = TipoRedSocialID::Twitter;
                            $LinkTwitter->save();
                        }

                        // LinkedIn
                        if( $socialModels->linkLinkedIn ){
                            $LinkLinkedIn = new RedSocial();
                            $LinkLinkedIn->Link = $socialModels->linkLinkedIn;
                            $LinkLinkedIn->PymeID = $model->Id;
                            $LinkLinkedIn->TipoRedSocialID = TipoRedSocialID::Linkedin;
                            $LinkLinkedIn->save();
                        }

                        // Youtube
                        if( $socialModels->linkYoutube ){
                            $LinkYoutube = new RedSocial();
                            $LinkYoutube->Link = $socialModels->linkYoutube;
                            $LinkYoutube->PymeID = $model->Id;
                            $LinkYoutube->TipoRedSocialID = TipoRedSocialID::YouTube;
                            $LinkYoutube->save();
                        }

                        // Website
                        if( $socialModels->linkWebsite ){
                            $LinkWebsite = new RedSocial();
                            $LinkWebsite->Link = $socialModels->linkWebsite;
                            $LinkWebsite->PymeID = $model->Id;
                            $LinkWebsite->TipoRedSocialID = TipoRedSocialID::Website;
                            $LinkWebsite->save();
                        }

                        // Correo Contacto
                        if( $socialModels->correoContacto ){
                            $LinkContacto = new RedSocial();
                            $LinkContacto->Link = $socialModels->correoContacto;
                            $LinkContacto->PymeID = $model->Id;
                            $LinkContacto->TipoRedSocialID = TipoRedSocialID::CorreoContacto;
                            $LinkContacto->save();
                        }

                        return $this->redirect(['view', 'id' => $model->Id]);
                    } 

                }
                
            }

        }

        return $this->render('create', [
            'model' => $model,
            'userModel' => $userModel,
            'socialModels' => $socialModels,
        ]);
    }

    /**
     * Updates an existing Pyme model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pyme model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pyme model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pyme the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pyme::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
