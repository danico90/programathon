<?php

namespace app\controllers;

use Yii;
use app\models\Redsocial;
use app\models\RedsocialSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RedsocialController implements the CRUD actions for Redsocial model.
 */
class RedsocialController extends Controller
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
     * Lists all Redsocial models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RedsocialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Redsocial model.
     * @param integer $TipoRedSocialID
     * @param integer $PymeID
     * @return mixed
     */
    public function actionView($TipoRedSocialID, $PymeID)
    {
        return $this->render('view', [
            'model' => $this->findModel($TipoRedSocialID, $PymeID),
        ]);
    }

    /**
     * Creates a new Redsocial model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Redsocial();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'TipoRedSocialID' => $model->TipoRedSocialID, 'PymeID' => $model->PymeID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Redsocial model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $TipoRedSocialID
     * @param integer $PymeID
     * @return mixed
     */
    public function actionUpdate($TipoRedSocialID, $PymeID)
    {
        $model = $this->findModel($TipoRedSocialID, $PymeID);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'TipoRedSocialID' => $model->TipoRedSocialID, 'PymeID' => $model->PymeID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Redsocial model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $TipoRedSocialID
     * @param integer $PymeID
     * @return mixed
     */
    public function actionDelete($TipoRedSocialID, $PymeID)
    {
        $this->findModel($TipoRedSocialID, $PymeID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Redsocial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $TipoRedSocialID
     * @param integer $PymeID
     * @return Redsocial the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($TipoRedSocialID, $PymeID)
    {
        if (($model = Redsocial::findOne(['TipoRedSocialID' => $TipoRedSocialID, 'PymeID' => $PymeID])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
