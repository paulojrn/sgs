<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use yii\data\ActiveDataProvider;
use app\models\Attendance;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
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
        $dataProvider = new ActiveDataProvider([
            'query' => Attendance::find()->orderBy(['type' => SORT_DESC, 'id' => SORT_ASC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {        
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
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
    
    public function actionSetAttendance()
    {        
        $post = Yii::$app->request->post();
        $msg = ['save' => true];
        
        $model = new Attendance();
        $model->setAttribute('type', $post['type']);
        $model->setQueueId();
        
        if(Yii::$app->user->id){
            $model->setAttribute('user_id', Yii::$app->user->id);
        }

        if(!$model->save()){
            $msg = ['save' => false];
        }

        echo json_encode($msg);
    }
    
    public function actionRemoveAttendance(){
        $first = Attendance::find()->orderBy(['type' => SORT_DESC, 'id' => SORT_ASC])->one();
        $msg = ['remove' => true];
        
        if(is_null($first)){
            $msg = ['remove' => false];
        }
        else{
            if(!$first->delete()){
                $msg = ['remove' => false];
            }
        }
        
        echo json_encode($msg);
    }
    
    public function actionResetCounters(){
        $post = Yii::$app->request->post();
        
        Attendance::resetCounters($post['param']);
    }
}
