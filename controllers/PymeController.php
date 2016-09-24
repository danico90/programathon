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
        $model = new Pyme();
        $socialModels = new PymeSocialMedias();
        $userModel = new Usuario();
        
        $userModel->load(Yii::$app->request->post());
        $model->load(Yii::$app->request->post());
        $socialModels->load(Yii::$app->request->post());

        if( $userModel && $model && $socialModels ) {

            if( $userModel->save() ) {

                $model->UsuarioID = $userModel->ID;
                $model->Logo = 'asdasdasd';
                $model->ExtensionLogo = '.png';
                $model->FechaCreacion = date("Y-m-d H:i:s");
                $model->FechaUltimaActualizacion = date("Y-m-d H:i:s");
                $model->EsFacebookAppInstalado = 0;

                if ($model->save()) {

                    $Linkfacebook = new RedSocial();
                    $Linkfacebook->Link = $socialModels->linkFacebook;
                    $Linkfacebook->PymeID = $model->Id;
                    $Linkfacebook->TipoRedSocialID = TipoRedSocialID::Facebook;
                    $Linkfacebook->save();

                    return $this->redirect(['view', 'id' => $model->Id]);
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
