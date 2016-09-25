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
            return $this->redirect('/site/dashboard');
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
            return $this->redirect('/site/dashboard');
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

        $dashboardModel->validate();

        $startDate = date("Y-m-d 00:00:00", strtotime($dashboardModel->startDate));
        $endDate = date("Y-m-d 23:59:59", strtotime($dashboardModel->endDate));

        $genero = Respuesta::findBySql("select count(*) as cnt, GeneroID
                                                        from Respuesta
                                                        where (FechaRespuesta >= '$startDate'
                                                        and FechaRespuesta <= '$endDate')
                                                        and PymeID = $model->Id
                                                        group by GeneroID")
                                                        ->all();


        $edad = Respuesta::findBySql("select count(*) as cnt, RangoEdad
                                                        from Respuesta
                                                        where (FechaRespuesta >= '$startDate'
                                                        and FechaRespuesta <= '$endDate')
                                                        and PymeID = $model->Id
                                                        group by RangoEdad")
                                                        ->all();
                                                        
                                                        

        $pregunta1 = $this->queryPregunta(1, $startDate, $endDate, $model->Id);
        $pregunta2 = $this->queryPregunta(2, $startDate, $endDate, $model->Id);
        $pregunta3 = $this->queryPregunta(3, $startDate, $endDate, $model->Id);
        $pregunta4 = $this->queryPregunta(4, $startDate, $endDate, $model->Id);
        $pregunta5 = $this->queryPregunta(5, $startDate, $endDate, $model->Id); 

        $dashboardModel->genero = $this->serialize($genero, 'GeneroID', 'cnt');
        $dashboardModel->edad = $this->serialize($edad, 'RangoEdad', 'cnt');
        $dashboardModel->pregunta1 = $this->serialize($pregunta1, 'Respuesta01', 'cnt');
        $dashboardModel->pregunta2 = $this->serialize($pregunta2, 'Respuesta02', 'cnt');
        $dashboardModel->pregunta3 = $this->serialize($pregunta3, 'Respuesta03', 'cnt');
        $dashboardModel->pregunta4 = $this->serialize($pregunta4, 'Respuesta04', 'cnt');
        $dashboardModel->pregunta5 = $this->serialize($pregunta5, 'Respuesta05', 'cnt');

        return $this->render('dashboard', [
            'pymeId' => Yii::$app->session->get('pyme'),
            'model' => $model,
            'dashboardModel' => $dashboardModel
        ]);
    }

    private function serialize($model, $key, $value)
    {
        $final['key'] = [];
        $final['value'] = [];
        foreach ($model as $item) {
            array_push($final['key'], $item->{$key});
            array_push($final['value'], $item->{$value});
        }
        return $final;
    }

    private function queryPregunta($pregunta, $startDate, $endDate, $id)
    {
        return Respuesta::findBySql("select count(*) as cnt, Respuesta0$pregunta
                        from Respuesta
                        where (FechaRespuesta >= '$startDate'
                        and FechaRespuesta <= '$endDate')
                        and PymeID = $id
                        group by Respuesta0$pregunta")
                        ->all();
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

    public function actionActivate()
    {
        $model = Pyme::findOne(['Id' => Yii::$app->session->get('pyme')]);
        if ($model)
        {
            $model->EsFacebookAppInstalado = 1;
            $model->save();
            echo 'activated';
        }
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
