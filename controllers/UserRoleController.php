<?php

namespace app\controllers;

use Yii;
use app\models\UserRole;
use app\models\UserRoleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserRoleController implements the CRUD actions for UserRole model.
 */
class UserRoleController extends Controller
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
     * Lists all UserRole models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserRoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserRole model.
     * @param integer $UserID
     * @param integer $RoleID
     * @return mixed
     */
    public function actionView($UserID, $RoleID)
    {
        return $this->render('view', [
            'model' => $this->findModel($UserID, $RoleID),
        ]);
    }

    /**
     * Creates a new UserRole model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserRole();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'UserID' => $model->UserID, 'RoleID' => $model->RoleID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserRole model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $UserID
     * @param integer $RoleID
     * @return mixed
     */
    public function actionUpdate($UserID, $RoleID)
    {
        $model = $this->findModel($UserID, $RoleID);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'UserID' => $model->UserID, 'RoleID' => $model->RoleID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserRole model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $UserID
     * @param integer $RoleID
     * @return mixed
     */
    public function actionDelete($UserID, $RoleID)
    {
        $this->findModel($UserID, $RoleID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserRole model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $UserID
     * @param integer $RoleID
     * @return UserRole the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($UserID, $RoleID)
    {
        if (($model = UserRole::findOne(['UserID' => $UserID, 'RoleID' => $RoleID])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
