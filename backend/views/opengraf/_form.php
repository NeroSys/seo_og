<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Opengraf */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="opengraf-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <!-- Basic Form Elements Block -->
            <div class="block">
                <!-- Basic Form Elements Title -->
                <div class="block-title">
                    <div class="block-options pull-right">
                        <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default toggle-bordered enable-tooltip" data-toggle="button" title="Toggles .form-bordered class">SEO && OG</a>
                    </div>
                    <h2><strong>Основные</strong> данные</h2>
                </div>
                <!-- END Form Elements Title -->

                <!-- Basic Form Elements Content -->
                <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

                <?php if($model->isNewRecord): ?>

                    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

                <?php else:?>

                    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

                <?php endif; ?>

                <?= $form->field($model, 'video')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'audio')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'localeAlternative')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'GAuthor')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'GPublisher')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'app_id')->textInput() ?>
                <!-- END Basic Form Elements Content -->
            </div>
            <!-- END Basic Form Elements Block -->
        </div>
        <div class="col-md-6">
            <!-- Basic Form Title -->
            <div class="block">
                <!-- Basic Form Elements Title -->
                <div class="block-title">
                    <div class="block-options pull-right">
                        <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default toggle-bordered enable-tooltip" data-toggle="button" title="Toggles .form-bordered class">SEO</a>
                    </div>
                    <h2><strong>Title</strong> </h2>
                </div>
                <!-- END Form Elements Title -->

                <!-- Basic Form Elements Content -->

                <?php foreach ($langs as $lang): ?>

                        <p><?= $lang->name?></p>
                        <?php
                        if(!$model->isNewRecord) $transcription = $model::getValue($model->id, $lang->id);
                        ?>

                        <?if(!empty($transcription)){?>
                            <?= $form->field($model,'title['.$lang->id.']['.$transcription->id .']')->label('')->textInput(['maxlength' => true, 'value' => $transcription['title']])?>
                        <?} else {?>
                            <?= $form->field($model,'titleNew['.$lang->id.'][]')->label('')->textInput(['maxlength' => true, 'value' => ''])?>
                        <?}?>

                <?php endforeach; ?>
                <!-- END Basic Form Elements Content -->
            </div>
            <!-- END Basic Form Title -->

            <!-- Basic Form Keywords -->
            <div class="block">
                <!-- Basic Form Elements Title -->
                <div class="block-title">
                    <div class="block-options pull-right">
                        <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default toggle-bordered enable-tooltip" data-toggle="button" title="Toggles .form-bordered class">SEO</a>
                    </div>
                    <h2><strong>Keywords</strong> </h2>
                </div>
                <!-- END Form Elements Title -->

                <!-- Basic Form Elements Content -->

                <?php foreach ($langs as $langK): ?>

                    <p><?= $langK->name?></p>
                    <?php
                    if(!$model->isNewRecord) $transcription = $model::getValue($model->id, $langK->id);
                    ?>
                    <?if(!empty($transcription)){?>
                        <?= $form->field($model,'keywords['.$langK->id.']['.$transcription->id .']')->label('')->textarea(['rows' => 4, 'cols' => 5, 'value' => $transcription['keywords']])?>
                    <?} else {?>
                        <?= $form->field($model,'keywordsNew['.$langK->id.'][]')->label('')->textarea(['rows' => 4, 'cols' => 5, 'value' => ''])?>
                    <?}?>

                <?php endforeach; ?>
                <!-- END Basic Form Elements Content -->
            </div>
            <!-- END Basic Form Keywords -->


        </div>
        <div class="col-lg-12">
            <!-- Basic Form Description -->
            <div class="block">
                <!-- Basic Form Elements Title -->
                <div class="block-title">
                    <div class="block-options pull-right">
                        <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default toggle-bordered enable-tooltip" data-toggle="button" title="Toggles .form-bordered class">SEO</a>
                    </div>
                    <h2><strong>Description</strong> </h2>
                </div>
                <!-- END Form Elements Title -->

                <!-- Basic Form Elements Content -->

                <?php foreach ($langs as $langD){ ?>

                    <p><?= $langD->name?></p>
                    <?php
                    if(!$model->isNewRecord) $transcription = $model::getValue($model->id, $langD->id);
                    ?>
                    <?if(!empty($transcription)){?>

                        <?= $form->field($model, 'description['.$langD->id.']['.$transcription->id .']')->widget(CKEditor::className(), [
                            'options' => [
                                'row' => 4,
                                'value' => $transcription['description']],
                        ])?>

                    <?} else {?>
                        <?= $form->field($model, 'descriptionNew['.$langD->id.'][]')->widget(CKEditor::className(), [
                            'options' => [
                                'row' => 4,
                                'value' => ''],
                        ])->label('')?>
                    <?}?>

                <? } ?>
                <!-- END Basic Form Elements Content -->
            </div>
            <!-- END Basic Form Description -->
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Добавить тэги для OG:Facebook, Google+, Twitter'), ['class' => 'btn btn-lg btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
