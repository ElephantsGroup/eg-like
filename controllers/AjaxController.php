<?php

namespace elephantsGroup\like\controllers;

use Yii;
use elephantsGroup\like\controllers\BaseAjaxController;
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
class AjaxController extends BaseAjaxController
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

    public function additionalFeatureAdd($service_id, $item_id, $user_id)
    {

    }

    public function additionalFeatureRemove($service_id, $item_id, $user_id)
    {

    }
}
