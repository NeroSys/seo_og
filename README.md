# SEO && Open Graph for Yii2 (PRO UI-3 admin template)

## Специально для Bizon, BugeraVA и моей душеньки. Если вдруг случайно кто загуглит - вопросы можете задавать здесь или на dda.nesterenko@gmail.com.
В чистом виде этот код для "прикрутить на свой сайт" - НЕ ГОДИТСЯ. Надо дорабатывать. Но кто спросит - помогу по-человечески.

В модель страниц, товаров, категорий, статей или куда надо

## model

В модели для обработки и вывода СЕО и ОГ добавить:


//    Open graph

   ## public function getOpenGraph(){

        return $this->hasOne(Opengraf::className(), ['itemId' => 'id'])->andWhere(['modelName' => $this::className()]);
    }

   ## public function getOGItem($id){

        return Opengraf::find()->where(['modelName' => $this::className()])->andWhere(['itemId' => $id])->one();
    }

   ## public function getSEO($id){

        return Opengraf::find()->where(['modelName' => $this::className()])->andWhere(['itemId' => $id])->one();
    }

// End Open Graph

## backend проекта

В backend/views/<имя представления>/view.php

Добавить

               <!-- Meta Data Block -->
                <div class="block">
                    <!-- Meta Data Title -->
                    <div class="block-title">
                        <h2><i class="fa fa-google"></i> <strong><?= Yii::t('app', 'SEO && OG')?></strong> <?= Yii::t('app', 'модуль')?></h2>
                    </div>
                    <!-- END Meta Data Title -->

                    <?php

                    $tags = $model->getOGItem($model->id);

                    if (!empty($tags)) {

                        $seo = $model->getSEO($model->id);
                        $lang_seo = $seo->getDataItemsAdmin();



                        echo GridView::widget([

                            'dataProvider' => new ActiveDataProvider(['query' => $model->getOpenGraph()]),
                            'layout' => "{items}\n{pager}",
                            'columns' => [
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{update} {delete} {link}',
                                    'buttons' => [
                                        'delete' => function ($url, $model, $key) {
                                            return Html::a('<btn class="btn btn-danger">Удалить</btn>',
                                                ['opengraf/delete', 'id' => $model->id, 'itemId' => $model->itemId, 'controller' => \Yii::$app->controller->id],
                                                ['data-method' => 'post']
                                            );
                                        },
                                        'update' => function ($url, $model, $key) {
                                            return Html::a('<btn class="btn btn-primary">Редактировать</span>',
                                                ['opengraf/update', 'id' => $model->id, 'controller' => \Yii::$app->controller->id],
                                                ['data-method' => 'post']
                                            );
                                        },
                                    ],
                                    'controller' => 'opengraf',

                                ],
                            ],
                        ]);


                        ?>

                        <!-- Timeline Content -->
                        <div class="block-content-full">
                            <div class="timeline">
                                <ul class="timeline-list">
                                    <li class="active">
                                        <div class="timeline-icon"><i class="gi gi-pencil"></i></div>
                                        <div class="timeline-time"><small>SEO</small></div>
                                        <div class="timeline-content">
                                            <p class="push-bit"><a href="page_ready_user_profile.html"><strong>title</strong></a></p>
                                            <p class="push-bit"><?= $lang_seo['title'] ?></p>
                                        </div>
                                    </li>
                                    <li class="active">
                                        <div class="timeline-icon"><i class="gi gi-pencil"></i></div>
                                        <div class="timeline-time"><small>SEO</small></div>
                                        <div class="timeline-content">
                                            <p class="push-bit"><a href="page_ready_user_profile.html"><strong>keywords</strong></a></p>
                                            <p class="push-bit"><?= $lang_seo['keywords'] ?></p>
                                        </div>
                                    </li>
                                    <li class="active">
                                        <div class="timeline-icon"><i class="gi gi-pencil"></i></div>
                                        <div class="timeline-time"><small>SEO</small></div>
                                        <div class="timeline-content">
                                            <p class="push-bit"><a href="page_ready_user_profile.html"><strong>description</strong></a></p>
                                            <p class="push-bit"><?= $lang_seo['description'] ?></p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- END Timeline Content -->
                    <?php }else{
                        $controller = \Yii::$app->controller->id;

                        echo Html::a('Создать OG тэги', [
                            'opengraf/create',
                            'itemId' => $model->id,
                            'modelName' => $model::className(),
                            'controller' => $controller
                        ], ['class' => 'btn btn-lg btn-primary btn-block']);
                    }



                    ?>
                </div>
                <!-- END Meta Data Block -->
                
При первом выводе будет выводить кнопку добавления СЕО описаний на активных языках сайта + OpenGraph.

# frontend проекта

## в контроллере перед рендерингом представления (с учетом AppController)

$name = $page {или $product, $category == переменная, к которой сделано описание}->getSEO($page->id);

        if(!empty($name)) {

            $lang_name = $name->getDataItems();


            $this->setMeta(
                $lang_name['title'],
                $lang_name['keywords'],
                $lang_name['description'],
                $lang_name['title'],
                $name->type,
                $name->img,
                $name->url,
                true,
                true,
                $lang_name['description'],
                $name->video,
                \Yii::$app->language,
                true,
                $name->localeAlternative,
                $name->GAuthor,
                $name->GPublisher,
                $name->app_id

            );
        }

## во view 
для вывода на интерфейс получаем данные в языковой версии сайта на момент просмотра

<?php  $name = $page->getSEO($page->id);
if(!empty($name)) $lang_name = $name->getDataItems(); ?>

и сам вывод 

например, описание СЕО

<?php if (!empty($lang_name))$lang_name['description'] ?>
