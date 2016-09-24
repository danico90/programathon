<?php

namespace app\controllers;

use Yii;
use app\models\Estado;
use app\models\EstadoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class BaseController extends Controller
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

    public function init()
    {
         
        if (Yii::$app->request->pathInfo == 'site/login' || Yii::$app->request->pathInfo == 'pyme/create') {
            if (Yii::$app->session->get('user')) {
                
                return $this->redirect('/site/dashboard');
            }
        }
        else {
            
            if (!Yii::$app->session->get('user')) {
                
                return $this->redirect('/site/login');
            }
        }
        
        parent::init();
    }

   
}
