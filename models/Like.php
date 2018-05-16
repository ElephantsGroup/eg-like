<?php

namespace elephantsGroup\like\models;

use Yii;

/**
 * This is the model class for table "{{%eg_like}}".
 *
 * @property integer $id
 * @property string $ip
 * @property string $cookie
 * @property integer $item_id
 * @property integer $service_id
 * @property integer $user_id
 * @property integer $like
 * @property string $update_time
 * @property string $creation_time
 */
class Like extends \yii\db\ActiveRecord
{
    public static $_UNLIKE = 0;
    public static $_LIKE = 1;

    public static function getLike()
    {
        return [
            self::$_UNLIKE => Yii::t('app', 'Unlike'),
            self::$_LIKE => Yii::t('app', 'Like')
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eg_like}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip', 'cookie'], 'trim'],
            [['item_id', 'service_id', 'user_id', 'like'], 'integer'],
            [['update_time', 'creation_time'], 'date', 'format'=>'php:Y-m-d H:i:s'],
            [['ip'], 'string', 'max' => 32],
            [['cookie'], 'string', 'max' => 512],
            [['like'], 'default', 'value' => self::$_UNLIKE],
            [['item_id', 'service_id'], 'default', 'value' => 0],
            [['update_time'], 'default', 'value' => (new \DateTime)->setTimestamp(time())->setTimezone(new \DateTimeZone('Iran'))->format('Y-m-d H:i:s')],
            [['creation_time'], 'default', 'value' => (new \DateTime)->setTimestamp(time())->setTimezone(new \DateTimeZone('Iran'))->format('Y-m-d H:i:s')],
            [['like'], 'in', 'range' => array_keys(self::getLike())],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $base = Yii::$app->getModule('base');
        return [
            'id' => $base::t('ID'),
            'ip' => $base::t('IP'),
            'cookie' => $base::t('Cookie'),
            'item_id' => $base::t('Item ID'),
            'service_id' => $base::t('Service ID'),
            'user_id' => $base::t('User ID'),
            'like' => $base::t('Like'),
            'update_time' => $base::t('Update Time'),
            'creation_time' => $base::t('Creation Time'),
        ];
    }

    public function beforeSave($insert)
    {
        $date = new \DateTime();
        $date->setTimestamp(time());
        $date->setTimezone(new \DateTimezone('Iran'));
        $this->update_time = $date->format('Y-m-d H:i:s');
        if($this->isNewRecord)
            $this->creation_time = $date->format('Y-m-d H:i:s');
        return parent::beforeSave($insert);
    }





    /**
     * @inheritdoc
     * @return \common\models\LikeQuery the active query used by this AR class.
     */
    /*public static function find()
    {
        return new \common\models\LikeQuery(get_called_class());
    }*/
}
