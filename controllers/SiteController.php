<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Pyme;
use app\models\Dashboard;
use app\models\Respuesta;

class SiteController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            // 'access' => [
            //     'class' => AccessControl::className(),
            //     'only' => ['logout'],
            //     'rules' => [
            //         [
            //             'actions' => ['logout'],
            //             'allow' => true,
            //             'roles' => ['@'],
            //         ],
            //     ],
            // ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->session->get('user')) {
            return $this->redirect('/site/answersboard');
        }
        else {
            return $this->redirect('/site/login');
        }

    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/site/answersboard');
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionPymeImage($id)
    {

        header('Content-Type: image/' . $model->ExtensionLogo);

        $model = Pyme::findOne(['Id' => Yii::$app->session->get('pyme')]);

        print $model->Logo;

        exit();

    }

    public function actionDashboard()
    {
        $model = Pyme::findOne(['Id' => Yii::$app->session->get('pyme')]);

        $dashboardModel = new Dashboard;

        if (!$dashboardModel->load(Yii::$app->request->post())) {
            $dashboardModel->startDate = date('m/d/Y');
            $dashboardModel->endDate = date('m/d/Y');
        }

        $dashboardModel->genero = Respuesta::find()
                    ->select(['COUNT(*)'])
                    ->all();
        //print_r($dashboardModel->genero);

        

        return $this->render('dashboard', [
            'pymeId' => Yii::$app->session->get('pyme'),
            'model' => $model,
            'dashboardModel' => $dashboardModel
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        Yii::$app->session->destroy();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays poll page.
     *
     * @return string
     */
    public function actionPoll()
    {

        Yii::setAlias('@anyname', realpath(dirname(__FILE__).'/..').'\web\mock\poll.json');
        $stringFile = file_get_contents(Yii::getAlias('@anyname'));
        $object = json_decode($stringFile, false);
        return $this->render('poll', [
            'model' => $object
        ]);
    }
}
