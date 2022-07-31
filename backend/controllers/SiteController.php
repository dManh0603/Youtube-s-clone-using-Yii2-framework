<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\Subscriber;
use common\models\Video;
use common\models\VideoView;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        $userId = $user->id;
        $latestVideo = Video::find()
            ->latest()
            ->creator(Yii::$app->user->id)
            ->limit(1)
            ->one();

        $numberOfViews = VideoView::find()
            ->innerJoin(Video::tableName(),
                'video.video_id = video_view.video_id')
            ->andWhere(['video.created_by' => $userId])
            ->count();

        $numberOfSubscribers = $user->getSubscribers()->count();
        $subscribers = Subscriber::find()
            ->andWhere(['channel_id' => $userId])
            ->orderBy('created_at DESC')
            ->limit(3)
            ->all();

        return $this->render('index',[
            'latestVideo' => $latestVideo,
            'numberOfViews' => $numberOfViews,
            'numberOfSubscribers' => $numberOfSubscribers,
            'subscribers' => $subscribers,
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'blank';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }


    public function actionRedirect()
    {
        return $this->redirect(Yii::$app->urlManagerFrontEnd->createUrl(''));
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

}
