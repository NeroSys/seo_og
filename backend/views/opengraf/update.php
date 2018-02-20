<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Opengraf */

if ($model->modelName ==  'common\models\Pages'){

     $view = $item->slug;
}else{
    $view = 'view';
}


$this->title = Yii::t('app', 'Обновление тэгов для: ' . $item->name, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Вернуться на страницу просмотра: '), 'url' => [$controller.'/'.$view, 'id' => $model->itemId]];

$this->params['breadcrumbs'][] = Yii::t('app', 'Обновление');
?>
<div id="page-content">
    <div class="block full">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'langs' => $langs
    ]) ?>
    </div>
</div>
