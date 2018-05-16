<?php

namespace elephantsGroup\like\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use elephantsGroup\like\models\Like;
use yii\web\Cookie;

class Likes extends Widget
{
	public $language;
    public $service;
    public $item;
    public $color = 'black';
    public $view_file = 'likes';

	public function init()
	{
		if(!isset($this->language) || !$this->language)
			$this->language = Yii::$app->language;
        if(!isset($this->item) || !$this->item)
            $this->item = 0;
        if(!isset($this->service) || !$this->service)
            $this->service = 0;
        if(!isset($this->view_file) || !$this->view_file)
            $this->view_file = Yii::t('like', 'View File');
	}

    public function run()
	{
        if(Yii::$app->user->isGuest)
        {
            $cookies = Yii::$app->request->cookies;
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

        $user_id = (int) Yii::$app->user->id;
        if(Yii::$app->user->isGuest)
            $is_like = Like::find()->where(['item_id' => $this->item, 'service_id' => $this->service, 'cookie' => $cookies->getValue('visitor'), 'like' =>1 ])->one();
        else
            $is_like = Like::find()->where(['item_id' => $this->item, 'service_id' => $this->service, 'user_id' => $user_id, 'like' =>1 ])->one();

        return $this->render($this->view_file, [
            'item' => $this->item,
            'service' => $this->service,
            'color' => $this->color,
            'is_like' => $is_like,
        ]);
	}
}