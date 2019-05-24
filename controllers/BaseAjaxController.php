<?php

namespace elephantsGroup\like\controllers;

use Yii;
use elephantsGroup\like\models\Like;
use elephantsGroup\like\models\LikeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use elephantsGroup\base\EGController;
use yii\web\Cookie;

/**
 * AdminController implements the CRUD actions for Like model.
 */
class BaseAjaxController extends EGController
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
                    'add' => ['POST'],
                    'remove' => ['POST'],
                ],
            ],
        ];
    }

    public function actionAdd()
    {
        $like_module = Yii::$app->getModule('like');
        $response = [
            'status' => 500,
            'message' => $like_module::t('Server problem')
        ];

        try
        {
            $cookies = Yii::$app->request->cookies;
            if(Yii::$app->user->isGuest)
            {
                if (!$cookies || !$cookies->getValue('visitor'))
                {
                    $cookies = Yii::$app->response->cookies;
                    $cookies->add(new Cookie([
                        'name' => 'visitor',
                        'value' => md5(time() . rand(1, 100)),
                        'expire' => (time() + (3600)),
                    ]));
                }
            }
            $item_id = isset($_POST['item_id']) ? $_POST['item_id'] : 0;
            $service_id = isset($_POST['service_id']) ? $_POST['service_id'] : 0;
            $user_id = Yii::$app->user->isGuest ? 0 : (int)Yii::$app->user->id;
            $ip = Yii::$app->request->userIP;
            $visitor_cookie = $cookies->getValue('visitor');

            if(Yii::$app->user->isGuest)
            {
                $like = Like::find()
                    ->where(['item_id' => $item_id, 'service_id' => $service_id, 'cookie' => $visitor_cookie, 'like' => Like::$_LIKE])
                    ->one();
            }
            else
            {
                $like = Like::find()
                    ->where(['item_id' => $item_id, 'service_id' => $service_id, 'user_id' => $user_id, 'like' => Like::$_LIKE])
                    ->one();
            }

            if (!$like)
            {
                $model = new Like();
                $model->service_id = $service_id;
                $model->item_id = $item_id;
                $model->user_id = $user_id;
                $model->like = Like::$_LIKE;
                $model->ip = $ip;
                $model->cookie = $visitor_cookie;

                if ($model->save())
                {
                    $response = [
                        'status' => 200,
                        'message' => $like_module::t('Successful')
                    ];
                    $this->additionalFeatureAdd($service_id, $item_id, $user_id);
                }
                else
                    $response = [
                        'status' => 400,
                        'message' => $like_module::t('Failed to save')
                    ];
            } else
                $response = [
                    'status' => 200,
                    'message' => $like_module::t('Liked before')
                ];
        }
        catch(Exception $exp)
        {
            $response = [
                'status' => 500,
                'message' => $like_module::t('Server problem')
            ];
        }
        return json_encode($response);
    }

    public function actionRemove()
    {
        $like_module = Yii::$app->getModule('like');
        $response = [
            'status' => 500,
            'message' => $like_module::t('Server problem')
        ];

        try
        {
            $cookies = Yii::$app->request->cookies;
            if(Yii::$app->user->isGuest)
            {
                if (!$cookies || !$cookies->getValue('visitor'))
                {
                    $cookies = Yii::$app->response->cookies;
                    $cookies->add(new Cookie([
                        'name' => 'visitor',
                        'value' => md5(time() . rand(1, 100)),
                        'expire' => (time() + (3600)),
                    ]));
                }
            }
            $item_id = isset($_POST['item_id']) ? $_POST['item_id'] : 0;
            $service_id = isset($_POST['service_id']) ? $_POST['service_id'] : 0;
            $user_id = Yii::$app->user->isGuest ? 0 : (int) Yii::$app->user->id;
            $ip = Yii::$app->request->userIP;
            $visitor_cookie = $cookies->getValue('visitor');

            if(Yii::$app->user->isGuest)
            {
                $like = Like::find()
                    ->where(['item_id' => $item_id, 'service_id' => $service_id, 'cookie' => $visitor_cookie, 'like' => Like::$_LIKE])
                    ->orderBy(['id' => SORT_DESC])
                    ->one();
            }
            else
            {
                $like = Like::find()
                    ->where(['item_id' => $item_id, 'service_id' => $service_id, 'user_id' => $user_id, 'like' => Like::$_LIKE])
                    ->orderBy(['id' => SORT_DESC])
                    ->one();
            }

            if($like)
            {
                $like->like = Like::$_UNLIKE;
                if($like->save())
                {
                    $response = [
                        'status' => 200,
                        'message' => $like_module::t('Successful')
                    ];
                    $this->additionalFeatureRemove($service_id, $item_id, $user_id);
                }
                else
                    $response = [
                        'status' => 400,
                        'message' => $like_module::t('Failed to unlike')
                    ];
            }
            else
                $response = [
                    'status' => 200,
                    'message' => $like_module::t('Does not liked before')
                ];
        }
        catch(Exception $exp)
        {
            $response = [
                'status' => 500,
                'message' => $like_module::t('Server problem')
            ];
        }
        return json_encode($response);
    }
}
