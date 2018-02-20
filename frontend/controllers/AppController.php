<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 12/2/17
 * Time: 5:39 PM
 */

namespace frontend\controllers;


use yii\web\Controller;

class AppController extends Controller
{

    protected function setMeta(
        $title = null,
        $keywords = null,
        $description = null,
        $ogTitle = null,
        $ogType = null,
        $ogImage = null,
        $ogUrl = null,
        $ogImageWidth = '968',
        $ogImageHeight = '504',
        $ogDescription = null,
        $ogVideo = null,
        $ogLocale = null,
        $ogSiteName = 'InJazz | MusicMarket',
        $ogLocaleAlternative = null,
        $GAuthor = null,
        $GPublisher = null,
        $AppId = null

        ){

//        Open Graph data

        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'title', 'content' => "$title"]);
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
        $this->view->registerMetaTag(['name' => 'og:title', 'content' => "$ogTitle"]);
        $this->view->registerMetaTag(['name' => 'og:type', 'content' => "$ogType"]);
        $this->view->registerMetaTag(['name' => 'og:url', 'content' => "$ogUrl"]);
        $this->view->registerMetaTag(['name' => 'og:image', 'content' => "$ogImage"]);
        $this->view->registerMetaTag(['name' => 'og:image:width', 'content' => "$ogImageWidth"]);
        $this->view->registerMetaTag(['name' => 'og:image:height', 'content' => "$ogImageHeight"]);
        $this->view->registerMetaTag(['name' => 'og:description', 'content' => "$ogDescription"]);
        $this->view->registerMetaTag(['name' => 'og:video', 'content' => "$ogVideo"]);
        $this->view->registerMetaTag(['name' => 'og:locale', 'content' => "$ogLocale"]);
        $this->view->registerMetaTag(['name' => 'og:site_name', 'content' => "$ogSiteName"]);
        $this->view->registerMetaTag(['name' => 'og:locale:alternative', 'content' => "$ogLocaleAlternative"]);
        $this->view->registerMetaTag(['name' => 'google:publisher', 'content' => "$GPublisher"]);
        $this->view->registerMetaTag(['name' => 'google:author', 'content' => "$GAuthor"]);
        $this->view->registerMetaTag(['name' => 'fb:app_id', 'content' => "$AppId"]);

//      for Twitter
        $this->view->registerMetaTag(['name' => 'twitter:card', 'content' => "$ogImage"]);
        $this->view->registerMetaTag(['name' => 'twitter:title', 'content' => "$title"]);
        $this->view->registerMetaTag(['name' => 'twitter:description', 'content' => "$description"]);
        $this->view->registerMetaTag(['name' => 'twitter:image:src', 'content' => "$ogImage"]);
        $this->view->registerMetaTag(['name' => 'twitter:url', 'content' => "$ogUrl"]);
        $this->view->registerMetaTag(['name' => 'twitter:domain', 'content' => \Yii::$app->request->hostInfo]);
        $this->view->registerMetaTag(['name' => 'twitter:site', 'content' => "$ogSiteName"]);
        $this->view->registerMetaTag(['name' => 'twitter:creator', 'content' => "$GAuthor"]);


    }

}