<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Opengraf */

if ($modelName == 'common\models\Pages'){

    $view = $item->slug;
}else{
    $view = 'view';
}

$this->title = Yii::t('app', 'Добавить тэги для SEO && OG');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Opengrafs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Вернуться на страницу просмотра: '), 'url' => [$controller.'/'.$view, 'id' => $itemId]];

$this->params['breadcrumbs'][] = $this->title;
?>
<div id="page-content">
    <div class="block full">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'itemId' => $itemId,
        'modelName' => $modelName,
        'langs' => $langs
    ]) ?>
    </div>
</div>
