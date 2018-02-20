<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OpengrafSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="opengraf-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'modelName') ?>

    <?= $form->field($model, 'itemId') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'img') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'video') ?>

    <?php // echo $form->field($model, 'audio') ?>

    <?php // echo $form->field($model, 'localeAlternative') ?>

    <?php // echo $form->field($model, 'GAuthor') ?>

    <?php // echo $form->field($model, 'GPublisher') ?>

    <?php // echo $form->field($model, 'app_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
