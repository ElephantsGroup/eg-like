<?php

namespace elephantsGroup\like;

/*
	Module statistics for Yii2
	Authors : Jalal Jaberi
	Website : http://elephantsgroup.com
	Revision date : 2016/07/09
*/

use Yii;

class Module extends \yii\base\Module
{
    public $add_path = '/like/ajax/add';
    public $remove_path = '/like/ajax/remove';
    // public $defaultRoute = 'admin';
    // make a problem, when is not logged and request like url, it asks for username and passwrod, then
    // visitor know this action exists but not allowed
    // TODO: try to solve this problem

    public function init()
    {
        parent::init();

        if (empty(Yii::$app->i18n->translations['like']))
		{
            Yii::$app->i18n->translations['like'] =
			[
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages',
                //'forceTranslation' => true,
            ];
        }
    }

    public static function t($message, $params = [], $language = null)
    {
        return \Yii::t('like', $message, $params, $language);
    }
}
