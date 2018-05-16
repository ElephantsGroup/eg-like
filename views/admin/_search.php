<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model elephantsGroup\like\models\LikeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="like-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ip') ?>

    <?= $form->field($model, 'item_id') ?>

    <?= $form->field($model, 'service_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'like') ?>
    
    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'creation_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
